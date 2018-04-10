VicTheme HTML Object
======

PHP HTML builder classes using pure OOP design

The goal is to provide a single code base for all VicTheme.com Projects related to WordPress.
There is no guarantee that the classes will work outside WordPress environment, although standard
PHP functions will be used in most case.


The hiearchy of the classes system :

<pre>
HTML Core 
 |- HTML Elements such as table
 |- Form Class
 |    |- Form Elements such as Input, Select, Textarea, Legends, Fieldset etc.
 |- Bootstrap Elements
 |    |- Bootstrap elements such as accordion, tabs, panels etc
 |- Bootstrap Forms
 |    |- Bootstrap form elements extending Form Class
 |- Bootstrap Grid
 |    |- Grid and Column element for bootstrap
 |- FontAwesome
 |    |- Form for fontawesome object
 |    |- object
 |- jquery
 |    |- Elements - Various objects for building jQuery elements such as flipster and slick carousel
 |    |- form - additional form elements for building jQuery specific form such as the easing selector
 |- social share
 |    |- Object for building social sharing icon easily
 |- Timeline
 |    |- object for building timeline element easily
 |- Validator
 |    |- validator add on for the form objects
 |- Assets
 |    |- Generic asset library system for storing js / css assets to a single array
 |- Utility
 |    |- Collection of utility methods
 |- Autoloader
 |    |- Main autoloader class for detecting and loading sub classes
 |- Uid
 |    |- addon for html object to generate unique id for each object and its children
 |- Init
 |    |- Main initialization class for booting up the core systems
      
</pre>      
      

Example for simple use :

```php
// Build Tables using shortcut
$form = new VTCore_Html_Base();
$form
  ->Table(array(
    'headers' => array(),
    'contents' => array(),
  ));


// Build table using normal class initialization
$form = new VTCore_Html_Base();
$form->addChildren(new VTCore_Html_Table(array()));


// Echoing the HTML output
$form->render();


// Returning the HTML output
$form->__toString();


// Chaining
$form = new VTCore_Html_Base();
$form
  ->Table(array(
    'headers' => array(.... array of text or object ...),
    'contents' => array(.... array of objects ....),
  ))
  ->Element(array(... array of context ...));



// Add Child to wrapper via chaining
$form = new VTCore_Html_Base();
$form
  
  // Build the main wrapper
  ->Element(array())
  
  // Move the array pointer to Element
  ->lastChild()
  
  // Build the element inside the wrapper
  ->Element(array( ....)) 
  
  // Move the pointer back to parent
  ->getParent()


  // Table element will be appended after the main wrapper
  ->Table(array(
    'headers' => array(.... array of text or object ...),
    'contents' => array(.... array of objects ....),
  ));



// Add children via context
$form = new VTCore_Html_Base();
$form
  ->Element(array(
    'type' => 'div',
    'attributes' => array(
      'id' => 'html_id',
      'class' => array('htmlclass1', 'htmlclass2'),
    ),
    'children' => array(
    
      // The table will be wrapped inside the Element "html_id"
      new VTCore_Html_Table(array(... context ...)),
    
    ),
  ));



// Transversing back and forth parent and children
$form = new VTCore_Html_Base();
$form
  
  // Building the inner div
  ->Element(array(
    'type' => 'div',
  ))
  
  // Entering the inner div
  ->lastChild()
  
  // Injecting element to the inner div
  ->Element(array(
    'type' => 'span',
    'text' => 'I\'m at second level',
  ))
  
  // Move out the div inner back to main parent
  ->getParent()
  
  // Injecting the new element below the inner div
  ->Element(arrray(
    'type' => 'h1',
    'text' => 'back to first level',
  ))
  
  // Build the markup and echo the result
  ->render();

resuts :
<div><span>I'm at second level</span></div>
<h1>back to first level</h1>


```





