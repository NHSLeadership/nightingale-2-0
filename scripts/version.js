#!/usr/bin/env node
/**
 * Keep the theme version the same in every file.
 *
 *   npm run set-version 3.2.0    Set a new version in package.json, package-lock.json
 *                                and every other file that has the version.
 *   npm run check-version        Fail if any file (including package-lock.json) has a
 *                                different version, or if the Changelog section in
 *                                readme.txt has no entry for it.
 *                                (GitHub also passes the release tag to check it.)
 */
const fs = require( 'fs' );
const path = require( 'path' );

const root = path.resolve( __dirname, '..' );
let version = require( path.join( root, 'package.json' ) ).version;

function ordinalDate( d ) {
	const day = d.getDate();
	const suffix = [ 11, 12, 13 ].includes( day ) ? 'th' : { 1: 'st', 2: 'nd', 3: 'rd' }[ day % 10 ] || 'th';
	const month = d.toLocaleString( 'en-GB', { month: 'long' } );
	return `${ day }${ suffix } ${ month } ${ d.getFullYear() }`;
}

// Each rule: file and regex with the version in group 2.
const rules = [
	{ file: 'style.scss', re: /^(Version:\s*)(\S+)/m },
	{ file: 'style.css', re: /^(Version:\s*)(\S+)/m },
	{ file: 'readme.txt', re: /^(Version:\s*)(\S+)/m },
	{ file: 'readme.txt', re: /^(Stable tag:\s*)(\S+)/m },
	{ file: 'functions.php', re: /^(\s\*\s@version\s+)(\S+)/m },
	{
		file: 'index.php',
		re: /^(\s\*\s@version\s+)(\S+)(.*)$/m,
		replace: ( m, p1 ) => `${ p1 }${ version } ${ ordinalDate( new Date() ) }`,
	},
	{ file: 'README.md', re: /^(# Nightingale\s+)(\S+)/m },
	{ file: 'README.md', re: /(badge\/nightingale-v)([^-]+)(-)/ },
];

// Minimum versions that only change when one really needs the other.
const reminders = [
	{
		label: 'Minimum NHS Blocks version this theme asks for (functions.php, TGMPA)',
		file: 'functions.php',
		re: /'slug'\s*=>\s*'nhsblocks'[\s\S]*?'version'\s*=>\s*'([^']+)'/,
	},
];

function read( file ) {
	return fs.readFileSync( path.join( root, file ), 'utf8' );
}

function sync() {
	for ( const rule of rules ) {
		const content = read( rule.file );
		if ( ! rule.re.test( content ) ) {
			console.error( `Could not find the version in ${ rule.file }` );
			process.exit( 1 );
		}
		const replace = rule.replace || ( ( m, p1, p2, p3 ) => `${ p1 }${ version }${ typeof p3 === 'string' ? p3 : '' }` );
		fs.writeFileSync( path.join( root, rule.file ), content.replace( rule.re, replace ) );
	}
	console.log( `Version set to ${ version } in all files.` );
	console.log( `Now add a "=${ version }=" changelog entry to readme.txt, then run "npm run build && npm run compress".` );
}

function setVersion( newVersion ) {
	if ( ! newVersion ) {
		console.error( 'Give the new version, for example: npm run set-version 3.2.0' );
		process.exit( 1 );
	}
	if ( ! /^\d+\.\d+\.\d+$/.test( newVersion ) ) {
		console.error( `"${ newVersion }" is not valid. Use three numbers (x.y.z), for example: 3.2.0` );
		process.exit( 1 );
	}
	const isOlder = newVersion.split( '.' ).map( Number ).some( ( n, i, parts ) => {
		const current = version.split( '.' ).map( Number );
		return parts.slice( 0, i ).every( ( p, j ) => p === current[ j ] ) && n < current[ i ];
	} );
	if ( isOlder ) {
		console.error( `${ newVersion } is older than the current version ${ version }.` );
		process.exit( 1 );
	}
	for ( const file of [ 'package.json', 'package-lock.json' ] ) {
		const data = JSON.parse( read( file ) );
		data.version = newVersion;
		if ( data.packages && data.packages[ '' ] ) {
			data.packages[ '' ].version = newVersion;
		}
		fs.writeFileSync( path.join( root, file ), JSON.stringify( data, null, 2 ) + '\n' );
	}
	version = newVersion;
	sync();
}

function check( tag ) {
	const errors = [];
	for ( const rule of rules ) {
		const match = read( rule.file ).match( rule.re );
		if ( ! match ) {
			errors.push( `${ rule.file }: version not found` );
		} else if ( match[ 2 ] !== version ) {
			errors.push( `${ rule.file }: "${ match[ 0 ].trim() }" should be ${ version }` );
		}
	}
	const lock = JSON.parse( read( 'package-lock.json' ) );
	if ( lock.version !== version ) {
		errors.push( `package-lock.json: version "${ lock.version }" should be ${ version }` );
	}
	const lockRoot = lock.packages && lock.packages[ '' ];
	if ( ! lockRoot || lockRoot.version !== version ) {
		errors.push( `package-lock.json: packages[""].version "${ lockRoot && lockRoot.version }" should be ${ version }` );
	}

	// Only look in the Changelog section, not in Upgrade Notice or others.
	const changelogHeading = `=${ version }=`;
	const lines = read( 'readme.txt' ).split( '\n' );
	const start = lines.findIndex( ( line ) => /^==\s*Changelog\b/i.test( line ) );
	let end = lines.findIndex( ( line, i ) => i > start && /^==[^=]/.test( line ) );
	if ( end === -1 ) {
		end = lines.length;
	}
	if ( start === -1 ) {
		errors.push( 'readme.txt: no "== Changelog ==" section' );
	} else if ( ! lines.slice( start + 1, end ).some( ( line ) => line.replace( /\s/g, '' ) === changelogHeading ) ) {
		errors.push( `readme.txt: no changelog entry "=${ version }=" in the Changelog section` );
	}
	if ( tag && tag.replace( /^v/, '' ) !== version ) {
		errors.push( `git tag ${ tag } does not match version ${ version }` );
	}

	for ( const r of reminders ) {
		const m = read( r.file ).match( r.re );
		console.log( `Reminder - ${ r.label }: ${ m ? m[ 1 ] : 'not found' }` );
	}

	if ( errors.length ) {
		console.error( `\nVersion check failed for ${ version }:\n - ${ errors.join( '\n - ' ) }` );
		console.error( '\nFix: run "npm run set-version <version>", then rebuild.' );
		process.exit( 1 );
	}
	console.log( `Version check passed: ${ version }` );
}

const [ command, arg ] = process.argv.slice( 2 );
if ( command === 'set' ) {
	setVersion( arg );
} else if ( command === 'check' ) {
	check( arg );
} else {
	console.error( 'Usage: node scripts/version.js set <version> | check [tag]' );
	process.exit( 1 );
}
