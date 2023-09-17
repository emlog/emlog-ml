<p align="center">
  <img src="./admin/views/images/logo.png" width=100 />
</p>
<p align="center">
	<a href="https://github.com/emlog/emlog-ml/releases/latest"><img src="https://img.shields.io/github/v/release/emlog/emlog-ml?logo=github" alt="GitHub release" /></a>
	<a href="https://emlog.io/docs/#/"><img src="https://img.shields.io/badge/docsify-document-brightgreen" alt="Document" /></a>
</p>

<h3 align="center">

English | [简体中文](/README.zh-CN.md)

</h3>

# emlog

emlog is a lightweight blog and CMS website building system, dedicated to creating a better personal cloud content management system.

## Overview

* Markdown editor, auto save, more comfortable and worry-free creation
* User registration, login, contribution, management
* Multi-screen size adaptation, compatible with PC and mobile devices
* One-click template replacement, convenient and fast to create a personalized site
* Support powerful plugin extension function, freely choose practical plugins, make your site unlimited possibilities
* Multimedia resource manager, support upload management of pictures, audio, video, files, etc.
* Support article URL customization, better SEO effect
* Draft box function of article, convenient to save your unfinished article
* Clear article writing page, with automatic saving, writing articles more comfortable and worry-free
* Flexible sidebar component (widgets) management, easy to combine and customize your favorite components
* Custom pages to easily create message boards, navigation bars, personal profiles, etc.
* Multi-person co-writing, easy management of multiple writers in the background
* tag, secondary classification
* Uploaded pictures can be embedded into the content of the article at will, making your article vivid
* Data caching technology, faster site access
* Site data backup/restore

## Download

[Download emlog pro](https://emlog.io/download)

## Changelog

[changelog](https://emlog.io/docs/#/changelog)

## Requirements

* PHP5.6\PHP7\PHP8, PHP7.4 recommended
* MySQL5.6+, 5.6 is recommended
* Recommended server environment: Linux + nginx

## Installation Notes

1. Upload all the decompressed files to the web root directory of the server or virtual host, or upload the zip archive and decompress it online.
2. Visit the pre-resolved domain name on the browser, the program will automatically jump to the emlog installation page, and follow the prompts to install it.
3. The installation process will not create a database, you need to create it in advance, click to confirm the installation, the installation is successful.

## Docker via `docker-compose`

1. cp config.sample.php config.php
2. docker network create emlog_network
3. docker-compose up
4. http://localhost:8080

## Special thanks

[![Jet Brains](https://raw.githubusercontent.com/kainonly/ngx-bit/main/resource/jetbrains.svg)](https://www.jetbrains.com/)

Thanks for non - commercial open source development authorization by Jet Brains

## License Agreement

The license under which the Emlog software is released is the Free Software Foundation's GP Lv3 (or later): [LICENSE](/license.txt)
