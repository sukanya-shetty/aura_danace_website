<?php
/**
 * MAILER CONFIGURATION - TEMPLATE
 * 
 * DO NOT COMMIT mailer-config.php WITH ACTUAL CREDENTIALS TO GIT!
 * This file is in .gitignore for security.
 * 
 * Copy this file to mailer-config.php and fill in your actual values.
 * For production, use environment variables instead.
 */

// Gmail SMTP Configuration (Default)
define('MAIL_HOST', getenv('MAIL_HOST') ?: 'smtp.gmail.com');
define('MAIL_USERNAME', getenv('MAIL_USERNAME') ?: 'your-email@gmail.com');
define('MAIL_PASSWORD', getenv('MAIL_PASSWORD') ?: 'your-app-password');  // Use App Password, not regular password
define('MAIL_FROM_EMAIL', getenv('MAIL_FROM_EMAIL') ?: 'your-email@gmail.com');
define('MAIL_FROM_NAME', getenv('MAIL_FROM_NAME') ?: 'Aura Dance Academy');
define('MAIL_PORT', getenv('MAIL_PORT') ?: 465);  // 465 for SMTPS (SSL)

/**
 * IMPORTANT SECURITY NOTES:
 * 
 * 1. For Gmail:
 *    - Enable "Less secure app access" OR use "App Passwords" (recommended)
 *    - Create an App Password: https://myaccount.google.com/apppasswords
 *    - Use the 16-character app password, not your Gmail password
 * 
 * 2. Environment Variables:
 *    - Set these in your server's environment configuration
 *    - Example in .htaccess:
 *      SetEnv MAIL_HOST smtp.gmail.com
 *      SetEnv MAIL_USERNAME your-email@gmail.com
 *      SetEnv MAIL_PASSWORD your-app-password
 * 
 * 3. For InfinityFree:
 *    - Contact support for SMTP server details
 *    - Use InfinityFree's mail server (not Gmail)
 *    - Update these constants accordingly
 * 
 * 4. Never hardcode credentials in production
 * 5. Use strong, unique passwords
 * 6. Rotate credentials regularly
 */
?>
