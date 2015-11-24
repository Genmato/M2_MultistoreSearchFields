Genmato Multistore Search Fields extension for Magento2
====

This extension will add the option to select the storeview for a Product Attribute where it should be visible on the Advanced Search page.

Installation
====

This package is registered on [Packagist](https://packagist.org/packages/genmato/multistoresearchfields) for easy installation. In your Magento installation root run:

`composer require genmato/multistoresearchfields`

This will install the latest version in your Magento installation, when completed run:

```
php bin/magento module:enable Genmato_MultistoreSearchFields

php bin/magento setup:upgrade

php bin/magento cache:clean
```

This will enable the extension and run the Schema and Data scripts to create the database and insert a sample record.

Upgrades
====

When there is a updated version available, simply run (in your Magento installation root):

`composer update`

to download and install the updated version.

Configuration
=====

Updated the extension to allow you to select the store in the attribute 'Frontend Properties' tab. For the attributes that need to be available in a specific store you can select it here. If you want an attribute to be visible in all stores select 'All Store Views'.

![Attribute Configuration](http://s10.postimg.org/76bpi07u1/Screen_Shot_2015_01_10_at_08_31_28.png)

The result on the advanced search page:

![Advanced Search Form](http://s22.postimg.org/pkvvwe5i9/Screen_Shot_2015_01_10_at_08_31_37.png)

(C)2015 Genmato BV, The Netherlands.