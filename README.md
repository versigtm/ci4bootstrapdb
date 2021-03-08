# CI4 Bootstrap DB Tools

I'm working a lot with CodeIgniter 4, bootstrap and MySQL, so I needed a library to help me create the models and views faster. With this library you can:

- Create models for MySQL tables and views;
- Create a table (dataTable) to display the records in the model;
- Create a bootstrap form taking into account the specifics of each field

## Preparing (installing)
Open the file **app/Libraries/DBtools.php**, and uncomment the lines conaining the user, password, and database name, after filling them in with your info.

```sh
    'username' => 'user',
    'password' => 'password',
    'database' => 'database',
```

## Instantiating

For linux users, in a terminal emulator: 
```sh
cd [path_to_app_folder]
php spark serve -port 8090
```
or you can 'run in terminal' the **ignite** command.
For windows users... well... I haven't used windows since 2008... I'm sorry, you'll just need to figure out a way to run the **spark** script with the -port 8090 parameter, so you can access the app via http://localhost:8090

## Usage
Open a browser and go to http://localhost:8090
Select a table or a view from the dropdown at the top of the screen.

### Info page
- the table structure
- the 'external links' - meaning foreign keys
- the defined indexes
- the 'insert array' if you want to define default values
- the CREATE statement

### Model page
Contains the definition of the model, according to CI4 specs. !important - check the model properties when using timestamps (created_at, updated_at, deleted_at) to make sure they reflect the reality in your table

The model also has data validation enabled, based on the specifics of the table fields.

### Form page
Contains the html for the form element, to input data into the selected table.
It is also connected with the validation options and it has another cool feature for ENUM fields.

**Default data** - The form will assume that the form data is passed to the view through the `$formData` variable, and the form errors through `$formErrors`.

**ENUM fields** - by default they are interpreted as dropdowns. You can display tags for each enum value. For example, if you have a field ENUM('A','I'), it could mean anything. To make it more user friendly, you may want to create a dropdown with meaningful options (like **A**ctive / **I**nactive). In this case, you must specify the following string in the comments of the ENUM field, and the script will interpret them as labels for the dropdown values: 
```sh
value1:label one;value2:label two[;valueN:labelN]
```
or, in our case,
```sh
A:Active;I:Inactive
```
and, to be even more specific:
```sql
ALTER TABLE table_name CHANGE field_name ENUM('A','I') COMMENT 'A:active;I:inactive';
```

### Datatable
This will create the HTML for the table view of the data in the table. You can alter it as you wish. It assumes that the data is passed to the view throught the `$dataTable` variable.

Enjoy using it!
