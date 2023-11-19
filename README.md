# Library Storage System

This project implements a Library Storage System, providing functionalities for managing books and authors.\
The system is designed to handle complex tasks related to book management in a library.
## Pre Knowledge
We have 4 different files : 
- books.json and books.csv care storage of our books
- authors.json is list of authors
- command.json is your specified commandline. 
- The publishing date you return to user should be in format of time stamp.
- You are free to choose your own request / response cycle, but don't confuse yourself with this ,/ it can be decent to implement a merely simple cli-app                                                                

- Your deadline for the project is until end of the day. 


# Command.json
This file has two general keys : 1 - command_name  2 - parameters . 
You are just restricted in two keys. But for values you  are free to design your own system .

## Tasks

### Task 1: List of All Books

- Implement a paginated, filterable, and sortable list of all registered books.
- Allow users to choose the number of items per page and filter books by author.
- Sorting should be based of publish date

#### How to Use command for `Book Search`
To conduct a search for books based on specific criteria, modify the command.json file as follows:
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
## Explanation of Parameters:
command_name: Set this as `BookIndex` to initiate the book search process.

### parameters:

- `perPage`: Determines the number of books displayed per page. It should be an integer value.
- `page`: Specifies the page number of results to display. It should also be an integer value.
- `authors`: Filters books by author name(s). You can input a single author name or a list of authors.
- `titles`: Filters books by the selected title(s). You can input a single book title or a list of titles.
  Save the changes made to the command.json file.
### Usage Guidelines:
- Pagination: Adjust perPage and page to control the number of books displayed per page and navigate through the results.
- Filtering by Author or Title: Use the authors key to specify the author's name(s) and the titles key to specify the book title(s) for precise filtering.
  Ensure that the values for perPage and page are integers, and the command_name is exactly set to `BookIndex` to perform the book search.

Save the command.json file after making modifications and run the system to execute the book search based on the provided criteria.


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

### Task 4: Deleting a Specific Book

- Implement a soft-delete mechanism instead of permanent deletion.
- Allow books to be marked as deleted but still accessible for historical purposes.
- it should be based on deleting 

### Task 5 : Update existed Source

- Update multiple items in your resources 
- you should be able to update one or more resources in one request.


