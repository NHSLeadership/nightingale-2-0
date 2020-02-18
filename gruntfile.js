grunt.loadNpmTasks( 'grunt-wp-i18n' );
grunt.initConfig({
    makepot: {
        target: {
            options: {
                cwd: '',
                domainPath: '/languages',
                mainFile: 'nightingale.php',
                potFilename: 'nightingale.pot',
                processPot: function( pot, options ) {
                    pot.headers['report-msgid-bugs-to'] = 'https://github.com/NHSLeadership/nightingale-2-0/issues';
                    pot.headers['language-team'] = 'NHSLA Digital Team <support.nla@leadershipacademy.nhsuk>';
                    return pot;
                },
                type: 'wp-theme'
            }
        }
    }
});
