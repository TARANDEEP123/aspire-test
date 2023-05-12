<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://global-uploads.webflow.com/5ed5b60be1889f546024ada0/5ed8a32c8e1f40c8d24bc32b_Aspire%20Logo%402x.png" width="400"></a></p>

## About Aspire

All-in-one finance for growing businesses. Headquartered in Singapore, Aspire is a Y-Combinator backed technology
organization that serves growing businesses with convenient & inclusive financial services. An Aspire Business Account
is opened online with a few easy steps and gives customers access to a large variety of services.

There are two high-level modules one is User Module (Loan consumer) and Admin Module (Loan provider).

## User Module

User module consists of 12 APIs as follows:

- Sign Up: This API enables the user to sign up to aspire app with email, password, name, and address.
- Login: This API let user login to aspire app, through by email and password.
- Show Loan Types: This API is for displaying all the loan types provided by aspire.
- Apply Loan: This API enables the user to Apply for a loan, with two approach one that the user is logged in, and the
  second is user sign-up and apply.
- Premium Payment: With help of this API user can pay his premium of a loan.
- Upcoming Premium: This API gives details of all upcoming premiums' payments. Past to one week in the future.
- Loan History: The user can fetch all loan history of him with aspire through this API.
- Loan Detail: This API gives users full loan detail.
- Repayment History: This API enables the user to track his premium payment history easily.
- Repayment Detail: Gives details about specific premium payments.
- Early Loan Closure: If the user wants to close his loan before tenure, this API will calculate all the costs and then
  close it. Even waive off the extra interest that's pending.

## Admin Module

Admin module consists of 9 APIs in which 3 are full resource API as follows:

- Create User: Admin can create a user with email, password, name, and address. For Offline Loan Application.
- Approve Loan: This API enables Admin to approve the loan application of the user. The applied status loan only can be
  approved. Once the loan is approved then all EMI will get populated with due_date.
- Reject Loan: This API will reject the loan. The only applied status loan can be approved.
- Default Loan: Make loan user as a defaulter and can be done by the Admin only.
- Verify Payment: With this API admin will verify whether payment came or not against a premium.
- Payment Due: This API gives all the payments due against all the loans to the Admin user.

- Lookup Types: A full resource API that lets Admin post, get, put, delete records from this model. Lookup type is the
  high-level categorization of generic terms.
- Lookup Values: A full resource API that lets Admin post, get, put, delete records from this model. Lookup values are a
  sub-categorization of lookup types.
- Loan Type: A resource API that lets Admin set all the loan type schemes.

## Postman

You can download the postman collection for all the above APIs and start using it by setting up environment variables.
Download it from (https://www.getpostman.com/collections/56f9860db5d0d8d7489f)

## Procedure to run the Application

First, we have to set an environment with the following commands:

- `git clone https://github.com/TARANDEEP123/project-aspire.git`
- `cd project-aspire`
- `composer update` (Assuming composer is already installed)
- `npm i` (Assuming npm is there in the system)
- `npm run dev` (To create an asset of js and CSS files)

Second, we have to set database and have to seed it

- Set .env file with Database properties (e.g. credentials, port, name, etc.)
- Run command:`php artisan migrate`
- Run command: `php artisan db:seed`

Third, turn on the server by running the below command:

- `php artisan serve`

Fourth, now we are ready to run the application on the browser (Believing the server started at 8000 port)

- For user-login go to http://127.0.0.1:8000/ (username: taran@gmail.com, password: password )
- For admin-login go to https://127.0.0.1:8000/admin (username: admin@aspire.com,password: password )

## License

Aspire is built on the Laravel framework, which is open-sourced software licensed under
the [MIT license](https://opensource.org/licenses/MIT).

