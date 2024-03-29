# Auth

For details (arguments, return values), [refer to the API document](https://docs.saasus.io/reference/getuserinfo)

## User Info

- GetUserInfo ... Get User Info

## Basic Configuration

- GetBasicInfo ... Get Basic Configurations
- UpdateBasicInfo ... Update Basic Configurations

- FindNotificationMessages ... Get Notification Email Templates
- UpdateNotificationMessages ... Update Notification Email Template

- GetCustomizePages ... Get Authentication Page Setting
- UpdateCustomizePages ... Authentication Page Setting

- GetCustomizePageSettings ... Get Authentication Authorization Basic Information
- UpdateCustomizePageSettings ... Update Authentication Authorization Basic Information

## Authentication Info

- GetAuthInfo ... Get Authentication Info
- UpdateAuthInfo ... Update Authentication Info
- GetSignInSettings ... Get Password Requirements
- UpdateSignInSettings ... Update Password Requirements
- GetIdentityProviders ・・・Get sign-in information via external provider
- UpdateIdentityProvider ・・・Update sign-in information via external provider

## SaaS User Info

- GetSaasUsers ... Get Users

- GetSaasUser ... Get User
- CreateSaasUser ... Create SaaS User
- DeleteSaasUser ... Delete User

- UpdateSaasUserPassword ... Change Password

- UpdateSaasUserEmail ... Change Email

- RequestEmailUpdate ・・・Request User Email Update
- ConfirmEmailUpdate ・・・Confirm User Email Update

- CreateSecretCode ... Creates secret code for authentication application registration
- UpdateSoftwareToken ... Register Authentication Application

- GetUserMfaPreference ... Get User's MFA Settings
- UpdateUserMfaPreference ... Update User's MFA Settings

- SignUp ... Sign Up
- ResendSignUpConfirmationEmail ... Resend Sign Up Confirmation Email

- UnlinkProvider ... Unlink external identity providers

- RequestExternalUserLink ・・・Request External User Account Link
- ConfirmExternalUserLink ・・・Confirm External User Account Link

- SignUpWithAwsMarketplace ・・・Sign Up with AWS Marketplace
- ConfirmSignUpWithAwsMarketplace ・・・Confirm Sign Up with AWS Marketplace
- LinkAwsMarketplace ・・・Link an existing tenant with AWS Marketplace

### Tenant User Info

- GetAllTenantUsers ... Get Users
- GetAllTenantUser ... Get User Info

- GetTenantUsers ... Get Tenant Users

- GetTenantUser ... Get Tenant User
- CreateTenantUser ... Create Tenant User

- UpdateTenantUser ... Update Tenant User
- DeleteTenantUser ... Delete Tenant User

- CreateTenantUserRoles ... Create Tenant User Role
- DeleteTenantUserRole ... Delete Role From Tenant User

## Role Info

- GetRoles ... Get Roles
- CreateRole ... Create Role
- DeleteRole ... Delete Role

## User Attribute

- GetUserAttributes ... Get User Attributes
- CreateUserAttribute ... Create User Attribute
- DeleteUserAttribute ... Delete User Attribute

## Tenant Attribute

- GetTenantAttributes ... Get Tenant Attributes
- CreateTenantAttribute ... Create Tenant Attribute
- DeleteTenantAttribute ... Delete Tenant Attribute

## Tenant Info

- GetTenants ... Get Tenants
- GetTenant ... Get Tenant Details
- CreateTenant ... Create Tenant
- UpdateTenant ... Update Tenant Details
- UpdateTenantPlan ... Update Tenant Plan Information
- UpdateTenantBillingInfo ... Update Tenant Billing Information
- GetTenantIdentityProviders ・・・Get identity provider per tenant
- UpdateTenantIdentityProvider ・・・Update identity provider per tenant
- DeleteTenant ... Delete Tenant

## Tenant Invitation Info

- GetTenantInvitations ・・・Get Tenant Invitations
- CreateTenantInvitation ・・・Create Tenant Invitation
- GetTenantInvitation ・・・Get Tenant Invitation
- DeleteTenantInvitation ・・・Delete Tenant Invitation
- GetInvitationValidity ・・・Get Invitation Validity
- ValidateInvitation ・・・Validate Invitation

## Env Info

- GetEnvs ... Get Env Info

- GetEnv ... Get Env Details
- CreateEnv ... Create Env Info
- UpdateEnv ... Update Env Info
- DeleteEnv ... Delete Env Info

## Authentication/Authorization Info

- GetAuthCredentials ... Get Authentication/Authorization Information
- CreateAuthCredentials ... Save Authentication/Authorization Information
