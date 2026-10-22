# Security

We take security and the protection of private data extremely seriously. If you believe you have found a vulnerability or other issue which has compromised or could compromise the security of any of our systems or private data managed by our systems, please do not hesitate to contact us using the method outlined below.

## Table of Contents

- [Security](#security)
  - [Table of Contents](#table-of-contents)
  - [Reporting a vulnerability](#reporting-a-vulnerability)
  - [General Security Enquiries](#general-security-enquiries)
  - [Dependency overrides (npm)](#dependency-overrides-npm)
  - [Current overrides](#current-overrides)
  - [Review policy](#review-policy)

## Reporting a vulnerability

If you believe you have found a security issue in this repository, please report it using GitHub's private vulnerability reporting:

1. [Report a vulnerability](https://github.com/NHSLeadership/nightingale-2-0/security/advisories/new)
2. Provide details of the issue and steps to reproduce

This creates a private channel for discussion and allows us to coordinate a fix before any public disclosure.

## General Security Enquiries

If you have general enquiries regarding our cybersecurity, please reach out to us at [cybersecurity@nhs.net](cybersecurity@nhs.net)

## Dependency overrides (npm)

This project uses npm `overrides` to temporarily address vulnerabilities in transitive build-time dependencies.

These packages are used for local development and build tooling (for example CSS compilation and critical CSS generation). They are not used by WordPress PHP runtime in production. At the time of writing, `npm audit --omit=dev` reports 0 vulnerabilities.

## Current overrides

- `brace-expansion` → `5.0.12`  
  Reason: Mitigates vulnerabilities reported in transitive dependency resolution.

- `extract-zip` → `2.0.1`  
  Reason: Addresses `extract-zip` advisory findings in the Puppeteer dependency chain.

- `puppeteer` → `25.15.0`  
  Reason: Pins a patched Puppeteer dependency chain used by `penthouse` for critical CSS generation, resolving transitive audit findings.

## Review policy

Overrides are reviewed during routine dependency updates and removed once upstream dependencies adopt patched versions natively.

Where possible, overrides are applied only to build-time tooling dependencies and validated by running install/build checks and security audit commands after updates.