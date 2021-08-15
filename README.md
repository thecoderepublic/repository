#### Laravel Repository and Service Class
##### Repository
A simplified method to have all Eloquent Queries isoltated in other classes than Eloquent in order to prevent code duplication or easly add caching.

Without a classical Repository implementation, this is just a new layer class over Eloquent. 

##### Service
A different layer to put the bussiness logic in. Following the pattern:
request -> controller -> call service -> get data from repository -> apply some logic -> return -> response

#### Installation
*composer require thecoderepublic/repository*
