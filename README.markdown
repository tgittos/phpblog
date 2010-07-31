phpblog
=======

phpblog is a blogging application written in PHP 5.

It was one of my first attempts at writing a blog application back when I first got involved in web programming. It uses all sorts of fancy PHP features, such as the autoloader, magic methods, OO and design patterns.

At one point it did actually run my personal blog for a few months until I realised that Wordpress did a much better job.

The code is here on github for posterity, and for reference purposes, however if you're curious, feel free to check it out.

Requirements
============

PHP 5, MySQL

Features
========

* Hash based user authentication and management
* SEO-friendly link structure
* Supports blog posts, comments, category tagging
* Built-in comment moderation
* Easy installer
* Search

Technical
=========

* Uses Doctrine ORM library
* Uses PHPTAL for templating
* YAML for installation data files
* The basics for a templating system. Template settings are currently hardcoded into core/Template.php

Installation
============

1. Create a new empty database. The installation process will create the database tables it needs.
2. Edit the config file, putting your details where appropriate. These include full path to the app, URL of the app and the database name and MySQL username and password.
3. Browse to /install eg: http://www.mywebsite.com/install. Hopefully the install process will install correctly.
4. Log in to your CMS at /admin eg: http://www.mywebsite.com/admin/. The username is "admin" and the password is "password"
5. Create your first post.
6. ???
7. Profit

Notes
=====

Don't use this application: use [http://www.wordpress.org](Wordpress) instead.