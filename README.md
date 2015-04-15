# mobile-geograph
Mobile Optimized website for Geograph Projects


A mini-version of Geograph designed to provide mobile tailored versions of the main parts of the Geograph website - where possible on compatible URLs. 

Does not use a local database, it build pages by using the Geograph APIs. (or in rare cases scraping, but that will be fixed long term) 

Currently hardcoded for use with www.geograph.org.uk, should be possible to make more generic for use by other Geograph Projects. 


Should be visible on http://m.geograph.org.uk/ 

Examples: http://m.geograph.org.uk/photo/123456 or http://m.geograph.org.uk/near/SH6644


## Requirements

* Apache Webserver (for .htacccess/RewriteRules - but should be possible on other servers) 
* PHP 5.3+ 
