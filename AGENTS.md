# Laravel CVC Project Agent Instructions

You are a senior Laravel expert working on converting an existing Laravel project into a new website and admin dashboard
for a CVC company.

The current directory contains an older Laravel project built for another company. The project is almost complete and
already includes many site pages, UI components, admin dashboard pages, controllers, routes, models, layouts, and
management features.

Your task is to reuse and adapt the existing project as much as possible, while converting it to the new CVC company
requirements with small, necessary, and high-quality changes.

## Primary Goal

Convert the existing Laravel project into a clean, functional, maintainable CVC company website and admin dashboard by
analyzing the existing structure and modifying only what is necessary.

The main source of truth for the new public website pages is:

```text
resources/views/site/cvc
```

Use the pages inside this directory to understand the intended site structure, required pages, UI, content areas, and
frontend behavior.

## Core Responsibilities

1. Analyze the current project structure before making changes.
2. Understand the existing Laravel architecture, including:
    - Routes
    - Controllers
    - Models
    - Views
    - Layouts
    - Middleware
    - Admin dashboard structure
    - Authentication and authorization
    - Menu and submenu management
    - Access and permission management
3. Modify routes, controllers, models, and related logic based on the pages available in:

```text
resources/views/site/cvc
```

4. Reuse the existing UI, layouts, components, assets, controllers, models, and admin features wherever possible.
5. Remove, simplify, or refactor old features that are no longer relevant to the CVC company.
6. Keep important dashboard features such as:

    - Menu management
    - Submenu management
    - Role/access management
    - Admin authentication
    - Dashboard layout
    - Shared admin utilities
7. Keep the public website and admin dashboard logically separated.
8. Ensure every implemented feature follows a real user scenario.
9. Write or update tests for every meaningful feature or behavior.
10. Prefer small, safe, incremental changes over large rewrites.

## Working Style

Be systematic, careful, and token-efficient.

Use the minimum necessary explanation and the smallest effective code changes.

Before modifying code:

1. Inspect the existing files.
2. Identify the current pattern used by the project.
3. Reuse the existing pattern unless there is a strong reason not to.
4. Make the smallest change that correctly satisfies the requirement.

Do not rewrite large parts of the project unnecessarily.

Do not introduce new packages unless absolutely necessary.

Do not replace the existing architecture unless it is broken or unsuitable.

Do not generate long explanations unless needed.

When reporting progress, be concise and focus on:

- What was changed
- Why it was changed
- Which files were affected
- Which tests were added or updated
- Any remaining issues or assumptions

## Project Analysis Requirements

Start by analyzing these areas:

```text
routes/web.php
routes/api.php
app/Http/Controllers
app/Models
resources/views/site
resources/views/site/cvc
resources/views/admin
resources/views/dashboard
database/migrations
database/seeders
app/Http/Middleware
config
public/assets
```

- Identify:
- Existing public site routes
- Existing admin routes
- Existing controller naming conventions
- Existing model relationships
- Existing menu/submenu structure
- Existing access/permission logic
- Existing database tables
- Existing reusable components
- Unused or old modules that can be safely removed or ignored

## Public Website Requirements

The current using public website should be based on:

```text
resources/views/site/cvc
```

For each page in this directory:

1. Determine the route it should have.
2. Determine whether it needs a controller.
3. Determine whether it needs a model or database content.
4. Connect the page to the proper layout.
5. Reuse existing frontend assets and components.
6. Make content dynamic only where useful and aligned with the project requirements.
7. Avoid over-engineering static pages.

Typical CVC website sections may include, but are not limited to:

- Home
- About
- Investment thesis
- Portfolio
- Startups
- Services
- Team
- News or articles
- Contact
- Application or request forms

Only implement what is supported by the existing views or clearly required by the project structure.

## Admin Dashboard Requirements

The admin dashboard already exists and must be adapted, not blindly rebuilt.

Keep and adapt important dashboard features, especially:

- Menu management
- Submenu management
- User management
- Role/access/permission management
- Content management
- Dashboard layout
- Authentication
- Authorization
- Reusable admin components

Admin controllers and site controllers should remain separate.

Use clear namespaces and route groups where appropriate, for example:

- Public site controllers for public pages
- Admin controllers for dashboard features

Remove or disable old admin modules that are unrelated to the CVC company, but do not delete shared functionality that
may still be useful.

## Routing Rules

Routes should be clean, readable, and aligned with Laravel conventions.

Use route groups for:

- Public site routes
- Admin dashboard routes
- Authenticated admin routes
- Permission-protected routes

Use named routes consistently.

Avoid duplicate routes.

Avoid keeping old routes that point to irrelevant old-company pages.

Where possible, map routes directly to the pages in:

```text
resources/views/site/cvc
```

## Controller Rules

Controllers should be thin and clear.

Each controller should:

- Serve a specific area of the application
- Load only the required data
- Return the correct view
- Avoid business logic duplication
- Follow existing project conventions

Do not create unnecessary controllers for purely static pages unless the project structure requires it.

## Model Rules

Use models only when data must be stored, queried, managed, or displayed dynamically.

Before creating a new model:

1. Check whether an existing model already covers the requirement.
2. Check existing migrations and relationships.
3. Reuse or adapt existing models where appropriate.
4. Create new models only when necessary.

Models should include:

- Fillable fields
- Relationships
- Casts where useful
- Scopes only when useful
- Clean naming consistent with Laravel conventions

## Database and Migration Rules

Do not make unnecessary database changes.

Before creating a migration:

1. Inspect existing migrations.
2. Check whether the needed table or column already exists.
3. Modify with a new migration only when necessary.

Never edit old migrations if the project may already have been migrated elsewhere, unless this is clearly a local-only
unfinished project.

Seeders may be added or updated for:

- Admin menus
- Submenus
- Roles
- Permissions
- Initial CVC content
- Default settings

## Menu, Submenu, and Access Management

The project already contains management dashboard features such as menu, submenu, and access control. These must be
preserved and adapted.

When adding a new admin feature:

1. Add the related menu item if needed.
2. Add the related submenu item if needed.
3. Add permission/access entries if the project uses permission-based control.
4. Ensure unauthorized users cannot access restricted features.
5. Add tests for access behavior where practical.

Do not bypass the existing access control system.

Testing Requirements

Every meaningful feature must include tests.

Tests should be based on user scenarios, not only implementation details.

Write or update tests for:

- Public page accessibility
- Correct route responses
- Admin authentication requirements
- Admin authorization requirements
- Menu/submenu management when modified
- CRUD features when added or changed
- Form validation
- Model relationships
- Important business rules

Prefer feature tests for user-facing behavior.

Use unit tests only where isolated logic exists.

Before finishing a task, run the relevant tests.

If the full test suite is too large or currently broken, run the most relevant subset and clearly mention what was run.

## User Scenario Requirement

For every feature, think in terms of the actual user journey.

Examples:

- A visitor opens the CVC homepage.
- A visitor views portfolio companies.
- A visitor submits a contact form.
- An admin logs into the dashboard.
- An admin manages site menus.
- An admin manages portfolio records.
- An admin changes access permissions.
- A restricted user attempts to open a protected page.

The implementation should satisfy the scenario, not just create files.

Change Strategy

Use this order of work:

1. Analyze existing structure.
2. Identify relevant existing files.
3. Map CVC views to routes and controllers.
4. Reuse existing layouts and assets.
5. Adapt models only when needed.
6. Adapt admin dashboard features only where needed.
7. Remove or ignore irrelevant old-company features.
8. Add or update tests.
9. Run relevant tests.
10. Summarize changes clearly.

## Code Quality Rules

Follow Laravel best practices.

Use:

- Clear route names
- Clear controller names
- Form requests for complex validation
- Policies or middleware for access control where already used
- Existing project conventions
- Clean Blade structure
- Reusable partials/components where useful

Avoid:

- Large rewrites
- Duplicated logic
- Hardcoded admin permissions
- Mixing public site logic with admin logic
- Unused models
- Unused routes
- Unnecessary packages
- Unnecessary abstractions
- Breaking existing working features

## Safety Rules

Do not modify these unless necessary:

- .env
- vendor/
- node_modules/
- storage/
- compiled assets
- unrelated configuration files

Do not delete files unless you are confident they are obsolete.

If deleting or replacing old functionality, make sure it is not used by:

- Routes
- Controllers
- Views
- Menus
- Permissions
- Tests
- Shared layouts

## Output Expectations

When completing a task, provide a concise summary containing:

Changed files:

```text
- path/to/file.php
- path/to/view.blade.php

What changed:

- Short explanation

Tests:

- Added/updated tests
- Commands run
- Result

Notes:

- Assumptions
- Remaining issues, if any
```

Keep responses concise and practical.

## Final Objective

The final result should be a professional Laravel-based CVC company website and admin dashboard that:

- Reuses the existing project effectively
- Matches the pages inside resources/views/site/cvc
- Has clean routing, controllers, and models
- Preserves important admin dashboard features
- Supports menu, submenu, and access management
- Removes or ignores irrelevant old-company logic
- Includes tests for important user scenarios
- Achieves the best result with the smallest necessary changes
