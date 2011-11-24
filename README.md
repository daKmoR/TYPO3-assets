Assets
======

This is an TYPO3 Extension to allow Listing of Files as Assets and Folders as Categories. There are multiple Asset Types available as jpg, doc, xls, html... Some of these types automatically read metadata if available.

Repository form a path
======================

In it's most basic use it creats a Repository of all files and folders within a given root path. All files are filled with all the information that is available. All filenames or foldernames shall not have special chars like äöü()/?... in their names. Also spaces should be avoided.

1) Read from file

  - Name = Filename without extension
    * _ are replaced with " "
    * leading numbers followed by a _ will be removed (so you can use it for ordering)
    * both changes can be disabled via configuration
  - PHP Class = file extension .jpg => Tx_Assets_Domain_Model_Jpg ...
  - file-size (in bytes)
  - file-change-date

2) Read metadata from file

  - read all metadata and if set replace values
  - e.g. Metadata Title = "new" then afterwards Name has a value of "new"

3) Read recursively info from .folderinfo

  - in this special file you can define properties for files and catgories which will overwrite the current value
  - it starts with the innermost .folderinfo and goes up to the root path
  - e.g. home\test\.folderinfo and home\.folderinfo
    * \home\test\.folderinfo will be applied
    * \home\.folderinfo will be applied so it values will always win

.folderinfo
-----------

Imagine the following Structure:

	myfolder/.folderinfo
	myfolder/012_big-river.jpg
	myfolder/020_perfect_shot_at_the_Sun.jpg
	myfolder/mySubfolder/.folderinfo
	myfolder/mySubfolder/another_image.jpg
	myfolder/mySubfolder/more_things_to_look_at.jpg

This would output if there is no metadata available.

- myfolder (category)
  - big-river (image)
  - perfect shot at the Sun (image)
  - mySubfolder (category)
     - another image (image)
     - more things to look at (image)

The .folderinfo uses the yaml language and therefore requires spaces as intendation. All subelement of the word "category" will overwrite the properties of the category. All subelement of the word "infoAssets" will be searched as filename and if found all subelement will overwrite the properites of the element.

See the following example of myfolder/.folderinfo:

	category:
	  name: my new Name

	infoAssets:
	  012_big-river.jpg:
	    name: another name?

This will change the output to:

- my new Name (category)
  - another name? (image)
  - perfect shot at the Sun (image)
  - mySubfolder (category)
     - another image (image)
     - more things to look at (image)

You an also define value for subcategories (subfolders) with the word "infoSubCategories". All subelements will be searched as foldername and if found you can use all words(category, infoAssets, infoSubCategories) again recursivly.

See the following example of myfolder/.folderinfo:

	infoSubCategories:
	  mySubfolder:
	    category:
	      name: this is new
	    infoAssets:
	      another_image.jpg:
	        name: this is different

This will change the output to:

- myfolder (category)
  - big-river (image)
  - perfect shot at the Sun (image)
  - this is new (category)
     - this is different (image)
     - more things to look at (image)

See the following example of myfolder/mySubfolder/.folderinfo:

	category:
	  name: my name from subfolder info

	infoAssets:
	  more_things_to_look_at.jpg:
	    name: filename from subfolder info

This will change the output to:

- myfolder (category)
  - big-river (image)
  - perfect shot at the Sun (image)
  - this is new (category)
     - this is different (image)
     - filename from subfolder info (image)

As you can see the filename of the last image is changed but the name of the category is different from the original foldername but not what we defined. This is due to the fact that the values from the myfolder/.folderinfo get included later and overwrite the name.

Following is a list of all available properties:

	category:
	  name: my new Name
	  description: string
	  roles: myGroup, myOtherGroup
	  extras:
	    anyNameYouWant: asString
	    anyNameYouWant: [as, arrray]

	infoAssets:
	  012_big-river.jpg:
	    name: string
	    caption: string
	    alternateText: string
	    description: string
	    copyright: string
	    keywords: myfiles, rivers, big stuff, cool
	    createDate: 28.10.2010
