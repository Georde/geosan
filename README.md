
# Geosan

### Geosan é uma ferramenta que facilita na criação de models, controllers, views, migrations e helpers no CodeIgniter MVC ou HMVC.

 - create:controller -	Diretiva para criar controllers
 - create:model - Diretiva para criar models 
 - create:view - Diretiva para criar views 
 - create:helper - Diretiva para criar helpers 
 - create:migration - Diretiva para criar migrations 

## Instalação:

*Dentro da pata do projeto abra o terminal e execute:*     
    
    composer require georde/geosan
*Finalizada a instalçao, execute*

    cp vendor/georde/geosan/geosan geosan
        
##Como usar:

####Criando Controllers
*Controller na pasta padrao*

    php geosan create:controller [nome]

*Controller em um módulo*

    php geosan create:controller [nome] [modulo]
    

####Criando Models
*Model na pasta padrao*

    php geosan create:model [nome]

*Model em um módulo*

    php geosan create:model [nome] [modulo]
    

####Criando Views
*View na pasta padrao*

    php geosan create:view [nome]

*View em um módulo*

    php geosan create:view [nome] [modulo]
    

####Criando migrations

    php geosan create:migration [nome]


####Criando helpers

    php geosan create:helper [nome]

