# mobile-geograph

A mini-version of Geograph designed to provide mobile tailored versions of the main parts of the Geograph website - where possible on compatible URLs. 

Does not use a local database, it build pages by using the Geograph APIs. (or in rare cases scraping, but that will be fixed long term) 

The eventual goal, is to be able to put rel=alternate and even a conditional redirect on the main website, so that mobile users get a more accessible version of the website. 


## Limitations

* Currently hardcoded for use with www.geograph.org.uk, should be possible to make more generic for use by other Geograph Projects. 
* Only some pages have mobile equivilents
* The homepage search is very basic, need to be able to enter gridref and/or placename, postcodes etc into the search box.
* In partcular is not providing a mobile optimized upload/submission procedure. 

## Example

* Should be visible on http://m.geograph.org.uk/ 
* examples of internal pages: http://m.geograph.org.uk/photo/123456 and http://m.geograph.org.uk/near/SH6644

## Requirements

* Apache Webserver (for .htacccess/RewriteRules - but should be possible on other servers) 
* PHP 5.3+ 
* Memcache (unused right now, but intend to add caching to improve performance) 
