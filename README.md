<p align="center"><img src="https://raw.githubusercontent.com/mms-gianni/klustair-frontend/master/docs/img/klustair.png" width="200"></p>

# KlustAIR Frontend
The Klustair scanner scanns your Kubernetes namespaces for the used images and scan them with trivy. This frontend displays the result of the scanned namespaces and images in a report. 

### Main Features: 
- The vulnerabilities of an images can be reviewed and whitelisted if they dont apply to any risk.
- Auditing the configuration of your kubernetes cluster 

### Related Klustair projects: 
- <a href="https://github.com/klustair/klustair">Klustair runner</a> to scan all your used images with trivy
- <a href="https://github.com/klustair/klustair-helm">Klustair Helm charts</a> to spin up Anchore and Klustair

### Related opensource projects
- <a href="https://github.com/aquasecurity/trivy">trivy</a> A Simple and Comprehensive Vulnerability Scanner for Containers and other Artifacts
- <a href="https://github.com/Shopify/kubeaudit">kubeaudit</a> kubeaudit helps you audit your Kubernetes clusters against common security controls
- (DEPRECATED) <a href="https://github.com/anchore/anchore-engine">anchore-engine</a> A service that analyzes docker images and applies user-defined acceptance policies to allow automated container image validation and certification

<br>
<br>

## Screenshots
<a href="https://github.com/klustair/klustair-frontend/blob/master/docs/screenshots/0.3.0/SCREENSHOTS.md">Find more screenshots here</a>

<img src="https://raw.githubusercontent.com/klustair/klustair-frontend/master/docs/screenshots/0.3.0/vulnerabilities.details.png" width="500" alt="vulnerabilities details">

<br>
<br>
<br>

## Configuration

### Laravel built in authentication
| ENV VAR       | Type    | value             | description                |
|---------------|---------|-------------------|----------------------------|
| AUTH          | Boolean | true\|**false**   | Enables Authentication     |
| AUTH_REGISTER | Boolean | true\|**false**   | Allows public registration |
| AUTH_RESET    | Boolean | true\|**false**   | Allows password reset      |
| AUTH_VERIFY   | Boolean | true\|**false**   | Enables E-Mail verfication |
<br>
<br>

### LDAP Authentication
|                 | Type    | value                                | description                                                               |
|-----------------|---------|--------------------------------------|---------------------------------------------------------------------------|
| LDAP            | Boolean | true\|**false**                      | Enables LDAP                                                              |
| LDAP_TYPE       | String  | **OpenLDAP**\|ActiveDirectory        | Preconfigured for OpenLDAP and Active Directory                           |
| LDAP_QUERYFIELD | String  | **uid**\|mail\|{custom}              | The field Klustair will try to find the User Account                      |
| LDAP_LOGGING    | Boolean | **true**\|false                      | Enable logging                                                            |
| LDAP_CONNECTION | String  | **default**                          | Since there is only default, you want to keep this value                  |
| LDAP_HOST       | String  | **openldap**\|custom                 | Hostname of the LDAP Server (without Protocol ldap://)                    |
| LDAP_USERNAME   | String  | **"cn=admin,dc=example,dc=org"**     | The DN Klustair uses to connect to LDAP                                   |
| LDAP_PASSWORD   | String  |                                      | The Password Klustair uses to connect to LDAP                             |
| LDAP_PORT       | Integer | **1389**\|389                        | LDAP listening port                                                       |
| LDAP_BASE_DN    | String  | **"ou=users,dc=example,dc=org"**     | DN where the users are located                                            |
| LDAP_TIMEOUT    | Integer | **5**                                | Query timeout                                                             |
| LDAP_SSL        | Boolean | true\|**false**                      |                                                                           |
| LDAP_TLS        | Boolean | true\|**false**                      |                                                                           |
<br>
<br>

## CLI Commands

### import CWE's (Common Weakness Enumeration)

```
php artisan klustair:importcwe <version> [<force>]
```
The current latest Version is 4.3 (2020-12-10) 
https://cwe.mitre.org/ 

### Manage User
```
php artisan klustair:user <action> [<email> [<fullname>]]
```
Available actions are : 
 - create [\<email\> [\<fullname\>]]
 - list
 - delete[\<email\>]
 
### Manage Tokens
```
php artisan lustair:token <action> [<name> [<email>]]
```
Available actions are : 
  - create [\<name\> [\<email\>]]
  - list
  - delete [\<name\>]

### Manage Init actions
```
php artisan lustair:init <action>]
```
Available actions are : 
  - waitForDB

### Test the LDAP Connection
```
php artisan ldap:test

+------------+------------+----------------------------+-------------------------+---------------+
| Connection | Successful | Username                   | Message                 | Response Time |
+------------+------------+----------------------------+-------------------------+---------------+
| default    | ✔ Yes      | cn=admin,dc=example,dc=org | Successfully connected. | 22.27ms       |
+------------+------------+----------------------------+-------------------------+---------------+
```

<br>
<br>

## Docker

Docker images an tags can be found on <a href="https://hub.docker.com/r/klustair/klustair-frontend">hub.docker.com</a>

- <b>klustair/klustair-frontend:v[VERSION]-apache</b><br>
  runs apache and PHP in a combined server. This container is based on Debian and is therefore bigger and has more vulnerabilities.

- <b>klustair/klustair-frontend:v[VERSION]-nginx</b><br>
  Alpine baes Nginx server

- <b>klustair/klustair-frontend:v[VERSION]-php-fpm</b><br>
  Alpine based php-fpm server

### Starting the Apache stack

    cd docker
    cp .env.example .env
    docker-compose up klustair-db klustair-apache

### Staring the Nginx/php-fpm stack

    cd docker
    cp .env.example .env
    docker-compose up klustair-db klustair-nginx klustair-php-fpm


