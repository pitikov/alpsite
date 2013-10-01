fapo
====

FAPO site storage

Для обеспечения работоспособности yii framwork (https://github.com/yiisoft/yii/archive/1.1.14.zip) разместить в каталоге уровнем выше

Должно получиться 
.
├── fapo
│   ├── assets
│   ├── css
│   ├── images
│   ├── protected
│   │   ├── commands
│   │   │   └── shell
│   │   ├── components
│   │   ├── config
│   │   ├── controllers
│   │   ├── data
│   │   ├── extensions
│   │   ├── messages
│   │   ├── migrations
│   │   ├── models
│   │   ├── runtime
│   │   ├── tests
│   │   │   ├── fixtures
│   │   │   ├── functional
│   │   │   ├── report
│   │   │   └── unit
│   │   └── views
│   │       ├── layouts
│   │       └── site
│   │           └── pages
│   └── themes
│       └── classic
│           └── views
│               ├── layouts
│               ├── site
│               └── system
├── framework
│   ├── base
│   ├── caching
│   │   └── dependencies
│   ├── cli
│   │   ├── commands
│   │   │   └── shell
│   │   ├── runtime
│   │   └── views
│   │       ├── shell
│   │       │   ├── controller
│   │       │   ├── crud
│   │       │   ├── form
│   │       │   ├── model
│   │       │   └── module
│   │       │       ├── components
│   │       │       ├── controllers
│   │       │       ├── messages
│   │       │       ├── models
│   │       │       └── views
│   │       │           ├── default
│   │       │           └── layouts
│   │       └── webapp
│   │           ├── assets
│   │           ├── css
│   │           ├── images
│   │           ├── protected
│   │           │   ├── commands
│   │           │   │   └── shell
│   │           │   ├── components
│   │           │   ├── config
│   │           │   ├── controllers
│   │           │   ├── data
│   │           │   ├── extensions
│   │           │   ├── messages
│   │           │   ├── migrations
│   │           │   ├── models
│   │           │   ├── runtime
│   │           │   ├── tests
│   │           │   │   ├── fixtures
│   │           │   │   ├── functional
│   │           │   │   ├── report
│   │           │   │   └── unit
│   │           │   └── views
│   │           │       ├── layouts
│   │           │       └── site
│   │           │           └── pages
│   │           └── themes
│   │               └── classic
│   │                   └── views
│   │                       ├── layouts
│   │                       ├── site
│   │                       └── system
│   ├── collections
│   ├── console
│   ├── db
│   │   ├── ar
│   │   └── schema
│   │       ├── mssql
│   │       ├── mysql
│   │       ├── oci
│   │       ├── pgsql
│   │       └── sqlite
│   ├── gii
│   │   ├── assets
│   │   │   ├── css
│   │   │   ├── images
│   │   │   └── js
│   │   │       └── fancybox
│   │   ├── components
│   │   │   └── Pear
│   │   │       └── Text
│   │   │           └── Diff
│   │   │               ├── Engine
│   │   │               └── Renderer
│   │   ├── controllers
│   │   ├── generators
│   │   │   ├── controller
│   │   │   │   ├── templates
│   │   │   │   │   └── default
│   │   │   │   └── views
│   │   │   ├── crud
│   │   │   │   ├── templates
│   │   │   │   │   └── default
│   │   │   │   └── views
│   │   │   ├── form
│   │   │   │   ├── templates
│   │   │   │   │   └── default
│   │   │   │   └── views
│   │   │   ├── model
│   │   │   │   ├── templates
│   │   │   │   │   └── default
│   │   │   │   └── views
│   │   │   └── module
│   │   │       ├── templates
│   │   │       │   └── default
│   │   │       │       ├── components
│   │   │       │       ├── controllers
│   │   │       │       ├── messages
│   │   │       │       ├── models
│   │   │       │       └── views
│   │   │       │           ├── default
│   │   │       │           └── layouts
│   │   │       └── views
│   │   ├── models
│   │   └── views
│   │       ├── common
│   │       ├── default
│   │       └── layouts
│   ├── i18n
│   │   ├── data
│   │   └── gettext
│   ├── logging
│   ├── messages
│   │   ├── ar
│   │   ├── bg
│   │   ├── bs
│   │   ├── cs
│   │   ├── de
│   │   ├── el
│   │   ├── es
│   │   ├── fa_ir
│   │   ├── fr
│   │   ├── he
│   │   ├── hu
│   │   ├── id
│   │   ├── it
│   │   ├── ja
│   │   ├── kk
│   │   ├── ko_kr
│   │   ├── lt
│   │   ├── lv
│   │   ├── nl
│   │   ├── no
│   │   ├── pl
│   │   ├── pt
│   │   ├── pt_br
│   │   ├── ro
│   │   ├── ru
│   │   ├── sk
│   │   ├── sr_sr
│   │   ├── sr_yu
│   │   ├── sv
│   │   ├── ta_in
│   │   ├── th
│   │   ├── tr
│   │   ├── uk
│   │   ├── vi
│   │   ├── zh_cn
│   │   └── zh_tw
│   ├── test
│   ├── utils
│   ├── validators
│   ├── vendors
│   │   ├── adodb
│   │   ├── bbq
│   │   ├── cldr
│   │   ├── gettext
│   │   ├── htmlpurifier
│   │   │   └── standalone
│   │   │       └── HTMLPurifier
│   │   │           ├── ConfigSchema
│   │   │           │   ├── Builder
│   │   │           │   ├── Interchange
│   │   │           │   └── schema
│   │   │           ├── EntityLookup
│   │   │           ├── Filter
│   │   │           ├── Language
│   │   │           │   ├── classes
│   │   │           │   └── messages
│   │   │           ├── Lexer
│   │   │           └── Printer
│   │   ├── jquery
│   │   │   ├── autocomplete
│   │   │   ├── maskedinput
│   │   │   └── treeview
│   │   ├── jqueryui
│   │   ├── json
│   │   ├── markdown
│   │   └── TextHighlighter
│   │       └── Text
│   │           └── Highlighter
│   │               └── Renderer
│   ├── views
│   │   ├── ar
│   │   ├── bg
│   │   ├── de
│   │   ├── el
│   │   ├── es
│   │   ├── fr
│   │   ├── he
│   │   ├── hr
│   │   ├── id
│   │   ├── it
│   │   ├── ja
│   │   ├── ko
│   │   ├── lt
│   │   ├── lv
│   │   ├── nl
│   │   ├── no
│   │   ├── pl
│   │   ├── pt
│   │   ├── pt_br
│   │   ├── ro
│   │   ├── ru
│   │   ├── sk
│   │   ├── sv
│   │   ├── uk
│   │   ├── vi
│   │   ├── zh_cn
│   │   └── zh_tw
│   ├── web
│   │   ├── actions
│   │   ├── auth
│   │   ├── filters
│   │   ├── form
│   │   ├── helpers
│   │   ├── js
│   │   │   └── source
│   │   │       ├── autocomplete
│   │   │       ├── jui
│   │   │       │   ├── css
│   │   │       │   │   └── base
│   │   │       │   │       └── images
│   │   │       │   └── js
│   │   │       ├── rating
│   │   │       ├── treeview
│   │   │       │   └── images
│   │   │       └── yiitab
│   │   ├── renderers
│   │   ├── services
│   │   └── widgets
│   │       ├── captcha
│   │       ├── pagers
│   │       └── views
│   └── zii
│       ├── behaviors
│       └── widgets
│           ├── assets
│           │   ├── detailview
│           │   ├── gridview
│           │   └── listview
│           ├── grid
│           └── jui
└── requirements
    ├── css
    ├── messages
    │   ├── ar
    │   ├── bg
    │   ├── cs
    │   ├── de
    │   ├── de_de
    │   ├── el
    │   ├── es
    │   ├── fr
    │   ├── he
    │   ├── hu
    │   ├── id
    │   ├── it
    │   ├── ja
    │   ├── nl
    │   ├── no
    │   ├── pl
    │   ├── pt
    │   ├── pt_br
    │   ├── ro
    │   ├── ru
    │   ├── sk
    │   ├── sv
    │   ├── ta_in
    │   ├── uk
    │   ├── vi
    │   ├── zh_cn
    │   └── zh_tw
    └── views
        ├── ar
        ├── bg
        ├── de
        ├── de_de
        ├── el
        ├── es
        ├── fr
        ├── he
        ├── it
        ├── ja
        ├── no
        ├── pl
        ├── pt
        ├── pt_br
        ├── ro
        ├── ru
        ├── sk
        ├── sv
        ├── uk
        ├── zh
        ├── zh_cn
        └── zh_tw


