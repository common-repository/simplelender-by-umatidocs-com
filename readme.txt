=== simplelender ===
Contributors:gkarogo
Tags: calculator, loan, loan calculator, loan crm, mortgage calculator, affiliate, loan affiliate marketing, responsive, loan company, leadsgate
Donate link:
Requires at least: 4.0
Tested up to: 5.2
Stable tag: trunk
Requires PHP: 5.4
Stable tag: trunk
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

[ New Software Alert ] A complete marketing tool for lenders, the only loan CRM on WordPress.

== Description ==
<strong>A complete marketing tool for lenders and the only loan management system on WordPress. It has a professional loan calculators and offers an option of <a href='https://github.com/umatidocs-labs/sample-calculator-extension'>adding a custom calculator</a>.</strong>

Are you a mortgage lender/ broker? <a href="https://wordpress.org/plugins/simplemortgage/">Try the new simplemortgage</a>

The plugin is for the professional lender looking to increase the level of engagement and loan application rate on their WordPress website.

SimpleLender <strong>unifies and personalizes</strong> the borrowers' user experience as they;
	+ Learn about loan products.
	+ Applying for a loan product.
	+ and when following up on a loan applications.

The lender on the other hand is able to easily manage loan applications on the admin side while being able to send data to 3rd party APIs.

KEY FEATURES
<ul>
	<li>
		<strong>Fast product  location by the borrower</strong>: Every borrower has a spending goal that need a specific financial solution, simplelender gets them to the right product fast irrespective of the number of loan products you offer..
	</li>
	<li>
		<strong>Unparalleled Loan Application Process</strong>: Loan application is a tedious process. Simplelender makes the process simplified and professional.
	</li>
	<li>
		<strong>Seamless Communication </strong>: Each borrower needs a simple, personalized and centralized communication  with their lender, with simplelender it is a reality.
	</li>
	<li>
		<strong>A Personal Touch</strong>: Away with the one message fits all. With simplelender, every email, every product and every dashboard notification is personalized for every borrower.
	</li>
</ul>

<strong>Centralize. Personalize. Simplify</strong>

<strong>Get Started</strong> (<a href='https://www.simplelender.website/'>0ur Website</a>)

== Installation ==
INSTALLATION
This section describes how to install the plugin and get it working.

1. Upload the plugin files to the `/wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the \'Plugins\' screen in WordPress
3. Click "save changes" on the "Permalink Settings" page
4. Create a loan product on Simplelender
5. Display loan product using short code [simplelender product=1] (Product id will be at the top after you create loan product)
Other shortcodes:
Loan Calculator: [simplelender product=1]
Login:  [sl_user_gate]

CREATE LOAN PRODUCT
On activation, you will be automatically be redirected to loan product creations, alternatively you will find it at simplelender->loan product (for the customizable form, use gravity form 2.4 or later)

IMPORTANT: After creating loan product, you need to go to Settings > Permalinks and click “save”. This flushes the WordPress rewrite rules. For performance reasons, the rewrite rules are only flushed either when the plugin is activated or when the Permalinks are saved. So, if you are developing with the plugin activated and adding controller routes as you go, you need to use this approach to flush the rewrite rules and use your new URL endpoints.

POST IT ON FRONTEND
Use the shortcode [simplelender product=1] where 1 is loan product id that you have created.

SUBMIT LOAN APPLICATION
Go to where you have put the form and fill  a loan application.

VIEW LOAN SUBMISSION
On the admin section, navigate to simplelender->loan applications and you will see all the latest application, from here you will be able to manage all the loan applications.

DO A DRIP CAMPAIGN TO FOLLOWUP ON BORROWERS AND GET THEM ACTIVE
You can now send new loan applicants to a drip marketing list on your best platform e.g. mailchimp, active campaign and CRM etc.

Ticket
On the frontend, the borrower is able to create a ticket and chat with the lender

Gravity form
To add additional forms on the loan application form, download gravity form at https://github.com/wp-premium/gravityforms/archive/master.zip create a goal form and secondary form on gravity plugin.
On simplelender->loan product, select the loan product on the and under gravity form field there is a 'goal form' dropdown section and 'secondary form' dropdown section. NB: you need to be a premium user to use this feature.

== Frequently Asked Questions ==
= I am getting a 404 when I add a new route =

You need to go to Settings > Permalinks and click “save”. This flushes the WordPress rewrite rules. For performance reasons, the rewrite rules are only flushed either when the plugin is activated or when the Permalinks are saved. So, if you are developing with the plugin activated and adding controller routes as you go, you need to use this approach to flush the rewrite rules and use your new URL endpoints.

= Does the plugin use a 3rd party service? =

No the plugin is a stand-alone and does not require you to create an account in a third party website.

= Does the plugin require the client side JavaScript to be active. =

Yes

== Screenshots ==
1. image1.png
2. image2.png
3. image3.png

== Changelog ==
No changes

== Upgrade Notice ==
Get more out of Simplelender
