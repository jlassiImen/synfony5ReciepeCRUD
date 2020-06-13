#synfony5ReciepeCRUD
A reciepe CRUD example with Synfony 5



Setup project
- Composer
    composer install
- Create Database
    php bin/console doctrine:database:create
- Load Migrations
    phph bin/console doctrine:migrations:migrate
- load fixtures
    php bin/console doctrine:fixtures:load
- Start server: symfony server:start
    
Available Api:
-Add reciepe : 
  -path :/recette/add/
  -Methode : POST
  -Body example : 
  {
  "titre" : "omelet ",
  "soustitre" : "BASIC FRENCH OMELET RECIPE",
  "ingredients" : ["2	large EGGS","2 Tbsp water","1/8 tsp salt"]
  }
 
 
-Search all reciepes Api:
  -path :/recette/searchAll
  -Methode : GET


-Search reciepe by Id Api:
  -path :/recette/searchById/id
  -Methode : GET
 
 -Update reciepe : 
  -path :/recette/update/id
  -Methode : PUT
  -Body example : 
  {
  "titre" : "omelet ",
  "soustitre" : "BASIC FRENCH OMELET RECIPE",
  "ingredients" : ["4	large EGGS","4 Tbsp water","1/4 tsp salt"]
  }
 
 
 
-Remove reciepe : 
  -path :/recette/remove/id
  -Methode : DELETE
  
  
