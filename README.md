# Codeigniter-HMVC-Geosan
#### Codeigniter 3.1.1 em HMVC.
#### Geosan é uma ferramenta que auxilia na criação da base de modulos de forma automática.

 - modulo - Diretiva para criar modulos
 - controller -	Diretiva para criar controllers
 - model - Diretiva para criar models 

# Baixar:  

*Abra o terminal e execute:*     
    
    composer create-project georde/geosan geosan --prefer-dist
  
  *Foi criado um projeto e já está no ponto de usar, com o Codeigniter configurado no padrão HMVC.*
  
# Como usar:

*Para usar o Geosan, digite no terminal:*

    php index.php geosan

*Se preferir, você pode criar um comando para agilizar a criação dos módulos (Recomendado)*

    vim ~/.bash_profile
  *Depois aperte ESC*
  
*Adicione no final do arquivo:*

    alias geosan="php index.php geosan"

*Salve e feche o editor vim:*

    :wq!
  
*Depois digite:*

    source ~/.bash_profile

**Pronto!**

  *Agora você pode usar o comando geosan para criar seus módulos no Codeigniter.*


###Criar módulos
   php index.php geosan modulo [nomedomodulo]
    
**Exemplo:**

    php index.php geosan modulo usuarios 
    
  *(Cria o módulo usuarios e as pastas controllers, views e models)*

###Criar controllers
    php index.php geosan controller [nomedomodulo] [nomedocontroller]
    
  **Exemplo:**
  
    php index.php geosan modulo usuarios admin 
  *(Cria o controller admin no módulo usuarios)*
  
###Criar Models
    php index.php geosan model [nomedomodulo] [nomedomodel] [tabela*] [chaveprimaria*]
    
  **Exemplo:**
 
    php index.php geosan model usuarios admin usuarios idUsuario 
  *(Cria o model admin no módulo usuarios e seta uma variável com o nome da tabela usuarios e seta uma variável como idUsuario)*
  
  **Exemplo2:**
 
    php index.php geosan model usuarios admin 
  *(Cria o model admin no módulo usuarios)*
