you will need to create the following simple retirement calculator. The idea of the calculation is to show to the user how much he needs to save per year if he wants to retire with a specific pension amount.

Retirement age is a constant: 65 years.
The expected retirement duration is also a constant: 25 years.

Let’s assume the following example:
The user is 40 years old, so till retirement, he has 25 years (65 years).
He is making $50,000 per year and he can save 30% of the funds for retirement.
This makes $15,000 per year which he will be putting aside as the investment.

In 25 years, he will save a total of $375,000.

Present in the calculation how much return will he have in total after 25 years, considering the inputted default yield from the input parameters. Pay attention that you need to progressively calculate the yield (considering that the sum is divided in 25 years payments of $15,000) - so the return on last $15,000 when the user is 64 years old is not same on the investment that he made when he was 40 and began to invest.

Present the savings result table per year (invested amount, yearly yield and accumulated yield).

Show the difference between the desired pension amount and the amount that the user has saved over the course of 25 years.


Make all the frontend inputs with slider component:

Age (min: 25; max: 65) 
Current earnings per year (min: $10.000; max: $100.000)
Desired pension amount (% of current yearly earnings, default value 85%)
(min: 10%; max; 200%)
Amount of savings per year for the retirement (min 10%; max 50%)
Default yield on savings fund: 2.00% per year
min(0.10%, max: 20%)




Outputs:

Savings result table per year (invested amount, yearly yield and accumulated yield).
Difference between the desired pension (compared to the current salary) versus what the user has saved during the course of investment (per parameters).
Show this on bar chart - highcharts.net component (simple two bars, expected versus accumulated).
Allow saving of the parameters in the database with the user profile name (so that it can be browsed later
Allow a simple admin grid view of saved user profiles with view/delete/save as pdf actions** in the table.
** allow saving of the results of the calculator in PDF file



Technologies:
Vue.js / Typescript
Docker to composite related services (e.g. DB)
As DB you can use MongoDB or MySQL
Backend: Yii2 

Upload source code/docker image to GitLab/GitHub and provide us with deployment instructions.
