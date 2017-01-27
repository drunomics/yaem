### Yet another embed module

##### Purpose

Provide a plugin system which allows embedding urls either with the 
use of oscaroteros [https://github.com/oscarotero/Embed](embed/embed) library 
or by implementing customized rendering strategies.

##### How it works

Using the yaem embed service, one can request a render array for any url. 

The service will go through the registered plugins and checks if they want to 
render the url, if multiple plugins want to render it, then the one with the 
heighest weight will be selected. 

This allows for easy overrides. General plugins should have lower weights than 
specific ones (eg.: Facebook should have a lower weight than Facebook Video).

Every plugin can either define it's own implementation or use the embed library
to fetch additional data for the url or use the embed code from the page.

If no applicable plugin is found the generic renderer will return the embed
code from the page.

##### Usage

###### field formatter

For fields of type `link` the field formatter `Yaem embed` can be selected, which
will try to render the given url with the appropiate plugin.

###### embed service

Inject the service into your Controller, Service, etc.

   `@yaem.service.embed`
   
   `$container->get(YAEM_EMBED_SERVICE)`

or directly

   `$embedService = \Drupal::get(YAEM_EMBED_SERVICE)`
    
Get the drupal render array for the url:

  `$embedService->renderUrl($url)`