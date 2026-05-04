# Change Workflow

## Goal

This workflow is for small, low-overhead changes in this repo.

It covers four steps:

1. Suggest an idea.
2. Turn the idea into a concrete proposal.
3. Implement it in a separate branch.
4. Verify it and merge it into `master`.

The same flow works for humans and AI agents.

## Core Rule

Keep each change small enough that one Markdown file and one branch are enough to understand it.

## Sources For Suggestions

A suggestion can come from:

- manual testing in the browser
- code reading
- review findings
- known issues in `docs/known-issues.md`
- AI analysis
- user feedback

## Flow

### 1. Suggestion

A suggestion is a short note.

It should answer only:

- what is wrong or weak?
- why is it worth changing?
- what area is affected?

Use the template in `docs/templates/suggestion-template.md`.

Storage rule for agents:

- if you are instructed to create suggestions, save each suggestion as a Markdown file under `docs/suggesstions/`

Good examples:

- search sorting uses raw query params and should be validated
- header rendering has inconsistent method signatures
- base path should not be hardcoded in routing

### 2. Proposal

If a suggestion looks useful, promote it to a proposal.

A proposal is still short, but it must be concrete enough to implement.

It should answer:

- problem
- intended change
- affected files or layers
- risks
- verification steps

Use the template in `docs/templates/proposal-template.md`.

## Proposal Storage

Store active proposals in:

- `docs/proposals/`

Recommended file name:

- `YYYY-MM-DD-short-name.md`

Example:

- `2026-05-04-route-base-path.md`

If `docs/proposals/` does not exist yet, create it when the first real proposal is added.

### 3. Branch

Each approved proposal gets its own branch.

Recommended naming:

- `feature/<topic>`
- `fix/<topic>`
- `refactor/<topic>`
- `docs/<topic>`

Examples:

- `fix/header-render-contract`
- `refactor/route-base-path`
- `docs/change-workflow`

Branch scope rule:

- one proposal
- one branch
- one merge decision

Branch decision rule for agents:

- if a task is a major code change and the user did not already specify branch instructions for that exact task, ask whether to create a branch and which base branch to use before editing code
- do not guess the base branch for major work
- smaller changes may stay on the current branch unless the user asks otherwise

### 3a. Commits

For non-trivial code changes, agents should prefer two commits:

1. a pre-change checkpoint commit
2. a post-change implementation commit

Checkpoint rule:

- first inspect `git status --short --branch`
- if the worktree is clean, or the current state is explicitly meant to be captured, create the checkpoint commit before editing code
- if unrelated or unexplained changes are already present, do not auto-commit them just to create a checkpoint; ask the user how to handle that state or continue without the checkpoint

Commit separation rule:

- keep user changes and agent changes separate where possible
- do not hide unrelated edits inside your implementation commit
- use commit messages that make the history readable without opening the diff

### 4. Implementation

During implementation:

- keep the proposal file updated if scope changes
- do not mix unrelated fixes into the same branch
- keep verification focused on the affected flow

### 5. Verification

At minimum, verify with the repo's existing checks:

- `php -l` for changed PHP files
- browser smoke test for affected routes

Standard routes for smoke tests:

- `/buecherantiquariat/`
- `/buecherantiquariat/home`
- `/buecherantiquariat/search?search=test`
- `/buecherantiquariat/detail?id=1`

If a proposal changes setup, routing, database expectations, or architecture, also update the matching file in `docs/`.

### 6. Merge

Merge into `master` only if:

- the proposal was implemented as described, or intentionally updated
- verification passed
- no blocking issues were found in review or manual testing

After merge:

- delete the branch if it is no longer needed
- mark the proposal as merged
- link follow-up work if new issues were discovered

## Human And AI Roles

Humans and AI can both work in any stage.

### Human-driven

- human writes suggestion
- AI turns it into a proposal
- human reviews the proposal
- human or AI implements it in a branch

### AI-driven

- AI scans code or docs and writes suggestions
- human selects one suggestion
- AI writes the proposal
- AI implements it in a branch
- human reviews and decides on merge

### Mixed mode

- human and AI both add suggestions
- the best suggestion is promoted
- implementation stays isolated per branch

## Minimal Review Standard

Use this short checklist before merge:

- Is the problem real in the current code?
- Is the proposal specific enough to implement?
- Does the branch stay within that scope?
- Were the affected routes checked?
- Were related docs updated?

## Keep It Light

This workflow should stay simple:

- suggestion: a few lines
- proposal: usually under one page
- branch: one topic only
- merge: only after verification

If a change does not need a proposal, do not force one.

Use proposals when they improve clarity, not as ceremony.
