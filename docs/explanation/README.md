# Learning Notes

## Goal

This folder is for beginner-friendly explanations created during research.

Each explanation should do two things:

1. answer the question in chat
2. save the same explanation as a Markdown file in this folder

## Folder Structure

- `docs/explanation/concepts/`: ideas such as MVC, dependency injection, routing
- `docs/explanation/terms/`: short technical terms such as enum, slug, middleware
- `docs/explanation/technologies/`: tools or platforms such as PHP, MySQL, Apache, XAMPP
- `docs/explanation/project/`: explanations tied directly to this repository

## How To Use It With AI

Ask for the explanation in one message and tell the AI to save it.

Example:

`Explain MVC to me like I am new to development. Give the explanation in chat and save it to docs/learning/concepts/mvc.md using the learning template.`

Another example:

`Explain what mysqli is, why this project uses it, and save the result to docs/learning/technologies/mysqli.md.`

## Suggested AI Prompt Shape

Use this format when you want a consistent result:

1. topic
2. audience level
3. relation to this project
4. output file path

Example:

`Explain routing for a beginner. Use examples from this PHP project. Give the answer in chat and save it to docs/learning/concepts/routing.md.`

## Writing Standard

Keep explanations:

- beginner-friendly
- concrete
- short enough to read in one sitting
- connected to this repo when useful

Prefer:

- plain language
- one small example
- one short "why it matters here" section

Avoid:

- unexplained jargon
- long generic textbook definitions
- examples unrelated to the project when a local example is available
