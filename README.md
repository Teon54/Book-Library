# Library Storage System

This project implements a Library Storage System, providing functionalities for managing books and authors.\
The system is designed to handle complex tasks related to book management in a library.

## Installation Guide
- To start using this software, follow these steps:

- Clone the Repository:

  ```git
  git clone [<repository_url>]
  ```
- Navigate to the Project Directory:

  ```git
  cd [<project_directory>]
  ```
- Install Dependencies:

  - Before running the application, make sure to install the necessary dependencies using Composer:

  ```git
  composer install
  ```
  - This command will install all the required libraries and packages for the application.

- Configure the Environment:

  - Set up any necessary configuration files or environment variables as specified in the documentation.

- Run the Application:

  - Once the dependencies are installed and the environment is configured:
  ```git
  php index.php
  ```
  - This command will start the application.

## Pre Knowledge

We have 4 different files :

- books.json and books.csv care storage of our books
- authors.json is list of authors
- command.json is your specified commandline.
- The publishing date you return to user should be in format of time stamp.
- You are free to choose your own request / response cycle, but don't confuse yourself with this ,/ it can be decent to
  implement a merely simple cli-app

- Your deadline for the project is until end of the day.

# Command.json

This file has two general keys : 1 - command_name 2 - parameters .
You are just restricted in two keys. But for values you are free to design your own system .

## Tasks

### Task 1: List of All Books

- Implement a paginated, filterable, and sortable list of all registered books.
- Allow users to choose the number of items per page and filter books by author.
- Sorting should be based of publish date

- To conduct a search for books based on specific criteria, modify the command.json file as follows:

- Open the `command.json` file in your preferred text editor.
- Edit the file to include the search parameters:
- ```json 
    {
    "command_name": "BookIndex",
    "parameters": {
    "perPage": 10,
    "page": 1,
    "authors": ["Aldous Orson"],
    "titles": ["Brave New World"]
      }
    } 
    ```

#### Explanation of Parameters:

- command_name: Set this as `BookIndex` to initiate the book search process.

- `parameters`:

    - `perPage`: Determines the number of books displayed per page. It should be an integer value.
    - `page`: Specifies the page number of results to display. It should also be an integer value.
    - `authors`: Filters books by author name(s). You can input a single author name or a list of authors.
    - `titles`: Filters books by the selected title(s). You can input a single book title or a list of titles.
- Save the changes made to the command.json file.

#### Usage Guidelines:

- Pagination: Adjust perPage and page to control the number of books displayed per page and navigate through the
  results.
- Filtering by Author or Title: Use the authors key to specify the author's name(s) and the titles key to specify the
  book title(s) for precise filtering.
  Ensure that the values for perPage and page are integers, and the command_name is exactly set to `BookIndex` to
  perform the book search.

Save the command.json file after making modifications and run the system to execute the book search based on the
provided criteria.

### Task 2: Getting a Specific Book

- Get a specific book based on its Isbn or return a not found message .

To retrieve information about a specific book based on its ISBN, follow these steps using the `command.json` file:

- Open the command.json file in your preferred text editor.

- Configure the file to retrieve details of a book using its ISBN:

- ```json 
    {
      "command_name": "GetBook",
      "parameters": {
        "ISBN": "978-0679413353"
      }
    }
    ```

#### Explanation of Parameters:

- `command_name`: Set this as GetBook to trigger the process of retrieving a specific book.

- `parameters`:
    - `ISBN`: Specifies the ISBN-13 of the book you want to retrieve details for.

- Save the changes made to the command.json file.

#### Usage Guidelines:

- ISBN Input: Replace `"978-0679413353"` with the ISBN-13 of the desired book.
- Ensure the ISBN provided is in the correct format (ISBN-13) for accurate retrieval.

- Save the `command.json` file after making modifications.

### Task 3: Adding a New Book

- Be aware the ISBN format should be ISBN-13.
- Support batch additions by allowing users to upload a CSV or JSON file with multiple new books.

To add one or multiple new books to the system through batch upload, follow these steps using the `command.json` file:

- Open the command.json file in your preferred text editor.

- Configure the file to include the paths to the JSON or CSV file(s) containing the new books' information:

- ```json 
    {
  "command_name": "AddBook",
  "parameters": {
    "paths": [
      "database/newbooks.json",
      "database/more_new_books.csv"
    ]
   }
  }

    ```

#### Explanation of Parameters:

- `command_name`: Set this as `AddBook` to trigger the process of adding new books to the system.

- `parameters`:
    - `paths`: Specify the path(s) to the JSON or CSV file(s) containing information about the new book(s). You can
      provide multiple file paths as an array.

- Save the changes made to the command.json file.

#### Usage Guidelines:

- File Paths: Replace the file paths (`"database/newbooks.json"`, `"database/more_new_books.csv"`, etc.) with the paths
  to your JSON or CSV file(s) containing information about the new book(s).
- Ensure that the file format is either JSON or CSV and that the file(s) contain the necessary book information in the
  expected format.

- Save the command.json file after modifying it with the correct file path(s) and format(s).

### Task 4: Deleting a Specific Book

- Implement a soft-delete mechanism instead of permanent deletion.
- Allow books to be marked as deleted but still accessible for historical purposes.
- it should be based on deleting

- To soft-delete a particular book from the system, follow these steps using the `command.json` file:

- Open the `command.json` file in your preferred text editor.

- Configure the file to specify the ISBN of the book to be soft-deleted:

- ```json
  {
  "command_name": "deletebook",
  "parameters": {
  "ISBN": "978-0735619678"
  }
  }
  ```

#### Explanation of Parameters:

- `command_name`: Set this as `deletebook` to trigger the process of soft-deleting a specific book.

- `parameters`:

    - `isbn`: Provide the ISBN-13 of the book you wish to soft-delete.

- Save the changes made to the `command.json` file.

#### Usage Guidelines:

- ISBN Input: Replace `"978-0735619678"` with the ISBN-13 of the book you want to soft-delete.
- Ensure the provided ISBN corresponds to the book you intend to soft-delete.
- Save the `command.json` file after modifying it with the correct ISBN of the book to be soft-deleted.

### Task 5 : Update existed Source

- Update multiple items in your resources
- you should be able to update one or more resources in one request.

- To update existing books in the system based on specific criteria, follow these steps using the `command.json` file:

- Open the `command.json` file in your preferred text editor.

- Configure the file to include both `search` and `replace` keys to update books based on defined criteria:

- ```json
  {
  "command_name": "updatebooks",
  "parameters": {
    "search": {
      "authors": ["Harold Jenkins"]
    },
    "replace": {
      "bookTitle": "Hello World"
    }
   }
  }

  ```

#### Explanation of Parameters:

- `command_name`: Set this as `updatebooks` to initiate the process of updating existing books.

- `parameters`:

    - `search`: Defines the criteria for searching and selecting books to update.
        - Available search criteria: `author`, `authors`, `title`, `titles`, `isbn`, `isbns`.
    - `replace`: Specifies the fields and their updated values for the selected books.
        - Available fields for replacement: `bookTitle`, `authorName`, `pagesCount`, `publishDate`.

- Save the changes made to the `command.json` file.

#### Usage Guidelines:

- ##### Search Criteria:

    - Use the `search` key to define criteria for selecting books to update. For
      instance, `"authors": ["Harold Jenkins"]` will select books authored by Harold Jenkins.
    - You can search by a single author or multiple authors using `"authors": ["Author1", "Author2"]`.
    - Available search keys are `author`, `authors`, `title`, `titles`, `isbn`, `isbns`.
- Replacement Fields:

    - Use the `replace` key to specify the fields and their updated values for the selected books.
    - Ensure the field names (`bookTitle`, `authorName`, `pagesCount`, `publishDate`) match exactly with the provided
      keys in the `replace` object.
- Save the `command.json` file after modifying it with the appropriate search criteria and replacement fields.
