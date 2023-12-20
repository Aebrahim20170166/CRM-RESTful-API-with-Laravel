# Basic CRM RESTful API

## Introduction

This is a basic CRM RESTful API that allows you to perform CRUD operations on customers, add invoices, notes, and projects to customers, notify customers with updates, and export customer data.
## Installation

To install and run the API, follow these steps:

1. Clone the repository.
2. Install the dependencies using `npm install`.
3. Configure the API by updating the `.env` file with your database credentials.
4. Start the API using `npm start`.

## Usage

To use the API, follow these steps:

1. Authenticate with the API using your authentication token.
2. Perform CRUD operations on customers using the `/customers` endpoint.
3. Add invoices, notes, and projects to customers using the `/customers/:id/invoices`, `/customers/:id/notes`, and `/customers/:id/projects` endpoints.
4. Notify customers with updates using the `/customers/:id/notify` endpoint.
5. Export customer data using the `/customers/export` endpoint.

## Endpoints

The following endpoints are available in the API:

- `/customers`: Perform CRUD operations on customers.
- `/customers/:id/invoices`: Add invoices to customers.
- `/customers/:id/notes`: Add notes to customers.
- `/customers/:id/projects`: Add projects to customers.
- `/customers/:id/notify`: Notify customers with updates.
- `/customers/export`: Export customer data.

## Authentication

To authenticate with the API, generate an authentication token using the `/auth` endpoint.

## Contributing

To contribute to the project, follow these steps:

1. Fork the repository.
2. Create a new branch.
3. Make your changes.
4. Submit a pull request.
