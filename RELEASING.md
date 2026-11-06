# Releasing Nightingale

Many websites rely on this theme, including a large number of NHS sites. Follow every step below for each release.

## 1. Set the new version

```bash
npm run set-version 3.2.0
```

This writes the version into every file: `package.json`, `package-lock.json`, `style.scss`, `style.css`, `readme.txt`, `functions.php`, `index.php` and `README.md`.

Do not edit version numbers by hand.

This command does not commit or create a git tag. You commit, and the tag is made on GitHub at release time.

Do not use `npm version`. It only changes `package.json` and `package-lock.json`.

## 2. Add a changelog entry

In `readme.txt`, under `== Changelog`, add `=3.2.0=` with a short list of changes.

For a big or risky change, also add a short `= 3.2.0 =` entry under `== Upgrade Notice ==`.

## 3. Check the NHS Blocks minimum version

In `functions.php`, find the TGMPA setting for `nhsblocks` and its `'version'`.

- If this theme release **needs** a newer NHS Blocks, change it to that version.
- Otherwise, leave it as it is.

## 4. Build and check

```bash
npm run build && npm run compress
npm run critical
npm run check-version
```

`check-version` must say **Version check passed**.

Run `npm run critical`, if CSS changed. It updates `partials/criticalcss.php`, the CSS that is placed in the page `<head>` so the header shows quickly. Before you run it:

- Your local site `https://demo.local` must be running, with Nightingale active.
- The Theme Colour must be the default **NHS Blue**.

If the CSS in `partials/criticalcss.php` changed, commit it.

## 5. Test

- Test on a site **with** NHS Blocks and a site **without** it.
- Test with a child theme, if possible.

## 6. Release

- Open a pull request. The **Version check** on GitHub must pass.
- After merging, create a GitHub release with the tag `v3.2.0` (with a "v", like earlier releases).
