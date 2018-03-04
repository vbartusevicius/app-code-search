app-code-search
===============

Allows to search for code fragments in various code hosting platforms.

#### Installation
  * run `composer install`
  * enter requested parameters

#### Implemented hosting platforms
  * `github` - https://developer.github.com/v3/search/#search-code
    * required parameters:
      * `vb_github_search_username` - your github username
      * `vb_github_search_token` - your github login token
      
You can implement search in other hosting platforms, 
just replace the `vb_code_search.search_handler` parameter in `config.yml`:
```yaml
vb_code_search:
    search_handler: vb_code_search.search_handler.github
```

#### Local usage
  * run `bin/console server:run localhost:8000`
  * make request: `GET http://localhost:8000/rest/v1/search/code?term=symfony`
    * supported query params:
      * `term` - term to search for; `string`
      * `page` - page number; `integer`
      * `per_page` - items per page; `integer`
      * `order_direction` - order direction; `string` enum `asc`, `desc`
      * `order_by` - order by; `string`
      
    Please check https://developer.github.com/v3/search/#parameters-2 for supported values
  * response consists of `items` and `_metadata`
    * `items` contains list objects with
      * `repository_name` - repository name where search term is found
      * `owner_name` - repository owner
      * `file_name` - file name in repository
    * `_metadata` contains 
      * `total` - total items count
      * `page` - page number
      * `per_page` - items per page
