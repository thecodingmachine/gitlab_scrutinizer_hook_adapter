Gitlab to Scrutinizer hook adapter
==================================

Here, at [TheCodingMachine](http://www.thecodingmachine.com), we make an extensive use of Gitlab.
We are also keen on working with Scrutinizer.

Alas, there is no real easy way to configure Push events on Gitlab.

Indeed, Gitlab comes sends a [special payload](https://gitlab.com/gitlab-org/gitlab-ce/blob/master/doc/web_hooks/web_hooks.md#push-events) with web hooks.
Scrutinizer on the other hand expects a completely different payload (see the *Setting Up a Post-Receive Hook* of your project to view the details).

This project is a very very thin wrapper that transforms hooks from Gitlab to Scrutinizer.

Set up
------

- Clone the repository
- Run `composer install`
- Copy `config.php.tmpl` to `config.php`
- In `config.php`, change the `SCRUTINIZER_API_TOKEN` entry to your API token.
- In Gitlab, add a "web hook" and point it to: http://[your-server]/[app_path]/hook/[Scrutinizer_project_name]

You are done!
