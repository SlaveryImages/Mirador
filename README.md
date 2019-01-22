# Mirador Module for Omeka S

## An Omeka S module to install and launch Mirador for items. 
A barebones implementation that gives you a new Mirador action for your items that will bring up an item in a new Mirador container page.  It contains the final release of Mirador 2.  

It is not intended for anyone who is not comfortable developing their own themes.  

We're interested in making this a full Omeka-S module, including support for annotations stored in the Omeka-S database and welcome funded projects and collaborations to add these -- or other -- new features.

## Installation
This module depends on the [IIIF Server module](https://omeka.org/s/modules/IiifServer/), so please install that first.

Download the last release from the [list of releases](https://github.com/SlaveryImages/Mirador/releases), uncompress it in the modules directory, and rename the module folder Mirador.  Then install it like any other Omeka module.

## Use
To call it within your theme you'll need to add the following to the item show page in your theme:
`<a href="<?php echo $item->url(); ?>/mirador" target="_blank">`

(We chose to do it with a IIIF icon underneath the image, see [this page for example](http://slaveryimages.org/s/slaveryimages/item/1751) and [the item show page](https://github.com/SlaveryImages/omeka-s-theme-slavery-images/blob/master/view/omeka/site/item/show.phtml#L47) for implementation details.)
