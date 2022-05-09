<?php
/**
 * @SWG\Swagger(
 *     schemes={"http"},
 *     host=API_HOST,
 *     basePath="/",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="Comiceria Api Document",
 *         termsOfService="",
 *     ),
 *     @SWG\SecurityScheme(
 *         name="Authorization",
 *         type="apiKey",
 *         in="header",
 *         securityDefinition="bearerAuth",
 *         description="Bearer Token",
 *     )
 * )
 */

/**
 * @SWG\Get(
 *     path="/api/v1/prefectures",
 *     description="Get Prefectures",
 *     summary="Get Prefectures",
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Post(
 *     path="/api/v1/login",
 *     description="Login",
 *     summary="Login",
 *    @SWG\Parameter(
 *         name="email",
 *         in="query",
 *         type="string",
 *         description="Your email",
 *         required=true,
 *     ),
 *     @SWG\Parameter(
 *         name="password",
 *         in="query",
 *         type="string",
 *         description="Your password",
 *         required=true,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Post(
 *     path="/api/v1/register",
 *     description="Register",
 *     summary="Register",
 *    @SWG\Parameter(
 *         name="email",
 *         in="query",
 *         type="string",
 *         description="Your email",
 *         required=true,
 *     ),
 *     @SWG\Parameter(
 *         name="password",
 *         in="query",
 *         type="string",
 *         description="Your password",
 *         required=true,
 *     ),
 *      @SWG\Parameter(
 *         name="password",
 *         in="query",
 *         type="string",
 *         description="Your password",
 *         required=true,
 *     ),
 *      @SWG\Parameter(
 *         name="last_name_kanji",
 *         in="query",
 *         type="string",
 *         description="Your last name kanji",
 *         required=true,
 *     ),
 *      @SWG\Parameter(
 *         name="first_name_kanji",
 *         in="query",
 *         type="string",
 *         description="Your first name kanji",
 *         required=true,
 *     ),
 *      @SWG\Parameter(
 *         name="last_name_kana",
 *         in="query",
 *         type="string",
 *         description="Your last name kana",
 *         required=true,
 *     ),
 *      @SWG\Parameter(
 *         name="first_name_kana",
 *         in="query",
 *         type="string",
 *         description="Your first name kana",
 *         required=true,
 *     ),
 *      @SWG\Parameter(
 *         name="phone",
 *         in="query",
 *         type="number",
 *         description="Your phone",
 *         required=false,
 *     ),
 *      @SWG\Parameter(
 *         name="nickname",
 *         in="query",
 *         type="string",
 *         description="Your nickname",
 *         required=true,
 *     ),
 *      @SWG\Parameter(
 *         name="date_of_birth",
 *         in="query",
 *         type="string",
 *         description="Your birthday",
 *         required=false,
 *     ),
 *      @SWG\Parameter(
 *         name="sex",
 *         in="query",
 *         type="number",
 *         description="Your sex",
 *         required=true,
 *     ),
 *      @SWG\Parameter(
 *         name="zip_code",
 *         in="query",
 *         type="string",
 *         description="Your zip code",
 *         required=false,
 *     ),
 *      @SWG\Parameter(
 *         name="city",
 *         in="query",
 *         type="string",
 *         description="Your city",
 *         required=false,
 *     ),
 *      @SWG\Parameter(
 *         name="subsequent_address",
 *         in="query",
 *         type="string",
 *         description="Your subsequent address",
 *         required=false,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Post(
 *     path="/api/v1/register/confirm",
 *     description="Confirm Register",
 *     summary="Confirm Register",
 *    @SWG\Parameter(
 *         name="token",
 *         in="query",
 *         type="string",
 *         description="Token register in mail",
 *         required=true,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Post(
 *     path="/api/v1/password/request",
 *     description="Send mail reset password",
 *     summary="Send mail reset password",
 *    @SWG\Parameter(
 *         name="email",
 *         in="query",
 *         type="string",
 *         description="Email",
 *         required=true,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Post(
 *     path="/api/v1/password/reset",
 *     description="Confirm reset password",
 *     summary="Confirm reset password",
 *    @SWG\Parameter(
 *         name="token",
 *         in="query",
 *         type="string",
 *         description="Token by send mail reset password",
 *         required=true,
 *     ),
 *    @SWG\Parameter(
 *         name="password",
 *         in="query",
 *         type="string",
 *         description="Password change",
 *         required=true,
 *     ),
 *    @SWG\Parameter(
 *         name="password_confirmation",
 *         in="query",
 *         type="string",
 *         description="Password change confirm",
 *         required=true,
 *     ),
 *    @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Get(
 *     path="/api/v1/events",
 *     description="Get events list",
 *     summary="Get events list",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     @SWG\Parameter(
 *         name="page",
 *         in="query",
 *         type="number",
 *         description="Page",
 *         required=true,
 *     ),
 *     @SWG\Parameter(
 *         name="perpage",
 *         in="query",
 *         type="number",
 *         description="Number of data per page",
 *         required=false,
 *     ),
 *     @SWG\Parameter(
 *         name="keyword",
 *         in="query",
 *         type="string",
 *         description="Keyword search",
 *         required=false,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Get(
 *     path="/api/v1/users/{user_id}/gifts",
 *     description="Get user gift list",
 *     summary="Get user gift list",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     @SWG\Parameter(
 *         name="user_id",
 *         in="path",
 *         type="number",
 *         description="User Id",
 *         required=true,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Get(
 *     path="/api/v1/leagues/{league_id}/books",
 *     description="Get entry book",
 *     summary="Get entry book",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     @SWG\Parameter(
 *         name="league_id",
 *         in="path",
 *         type="number",
 *         description="League Id",
 *         required=true,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Post(
 *     path="/api/v1/tokens/refresh",
 *     description="Get refresh token",
 *     summary="Get refresh token",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     @SWG\Parameter(
 *         name="refresh_token",
 *         in="query",
 *         type="string",
 *         description="Refresh Token",
 *         required=true,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Get(
 *     path="/api/v1/gifts",
 *     description="Get gifts",
 *     summary="Get list gifts",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Post(
 *     path="/api/v1/leagues/{league_id}/entry",
 *     description="Entry",
 *     summary="Entry",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     @SWG\Parameter(
 *         name="league_id",
 *         in="path",
 *         type="number",
 *         description="League Id",
 *         required=true,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Post(
 *     path="/api/v1/books/{book_id}/evaluate",
 *     description="Evaluate",
 *     summary="Evaluate",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     @SWG\Parameter(
 *         name="book_id",
 *         in="path",
 *         type="number",
 *         description="League Id",
 *         required=true,
 *     ),
 *     @SWG\Parameter(
 *         name="score",
 *         in="query",
 *         type="number",
 *         description="Score",
 *         required=true,
 *     ),
 *     @SWG\Parameter(
 *         name="league_id",
 *         in="query",
 *         type="number",
 *         description="League Id",
 *         required=false,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Get(
 *     path="/api/v1/comics",
 *     description="Get comics list",
 *     summary="Get comics list",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     @SWG\Parameter(
 *         name="page",
 *         in="query",
 *         type="number",
 *         description="Page",
 *         required=true,
 *     ),
 *     @SWG\Parameter(
 *         name="perpage",
 *         in="query",
 *         type="number",
 *         description="Number of data per page",
 *         required=false,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Get(
 *     path="/api/v1/home",
 *     description="Get data for home page",
 *     summary="Get data for home page",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Get(
 *     path="/api/v1/events/{event_id}",
 *     description="Event Detail",
 *     summary="Event Detail",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     @SWG\Parameter(
 *         name="event_id",
 *         in="path",
 *         type="number",
 *         description="Event Id",
 *         required=true,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Get(
 *     path="/api/v1/leagues/{league_id}/top-ranking",
 *     description="Get top ranking league",
 *     summary="Get top ranking league",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     @SWG\Parameter(
 *         name="league_id",
 *         in="path",
 *         type="number",
 *         description="League Id",
 *         required=true,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Get(
 *     path="/api/v1/fetch-user",
 *     description="Get jwt user info",
 *     summary="Get jwt user info",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Get(
 *     path="/api/v1/videos",
 *     description="Get videos list",
 *     summary="Get videos list",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     @SWG\Parameter(
 *         name="page",
 *         in="query",
 *         type="number",
 *         description="Page",
 *         required=true,
 *     ),
 *     @SWG\Parameter(
 *         name="perpage",
 *         in="query",
 *         type="number",
 *         description="Number of data per page",
 *         required=false,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Post(
 *     path="/api/v1/resend/email",
 *     description="Resend email register",
 *     summary="Resend email register",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     @SWG\Parameter(
 *         name="token",
 *         in="query",
 *         type="string",
 *         description="token",
 *         required=true,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Put(
 *     path="/api/v1/users/{user_id}/gifts/{user_gift_id}/tipping",
 *     description="Tipping",
 *     summary="Tipping",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     @SWG\Parameter(
 *         name="user_id",
 *         in="path",
 *         type="number",
 *         description="User jwt id",
 *         required=true,
 *     ),
 *     @SWG\Parameter(
 *         name="user_gift_id",
 *         in="path",
 *         type="number",
 *         description="User gift id",
 *         required=true,
 *     ),
 *     @SWG\Parameter(
 *         name="to_user_id",
 *         in="query",
 *         type="number",
 *         description="User Id get gift",
 *         required=true,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Get(
 *     path="/api/v1/leagues",
 *     description="Get leagues",
 *     summary="Get leagues",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Get(
 *     path="/api/v1/home/search",
 *     description="Home Search",
 *     summary="Home Search",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     @SWG\Parameter(
 *         name="page",
 *         in="query",
 *         type="number",
 *         description="Page",
 *         required=true,
 *     ),
 *     @SWG\Parameter(
 *         name="perpage",
 *         in="query",
 *         type="number",
 *         description="Number of data per page",
 *         required=false,
 *     ),
 *     @SWG\Parameter(
 *         name="keyword",
 *         in="query",
 *         type="string",
 *         description="Keyword search",
 *         required=false,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Post(
 *     path="/api/v1/users/{user_id}/gifts",
 *     description="Purchase gift",
 *     summary="Purchase gift",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     *@SWG\Parameter(
 *         name="user_id",
 *         in="path",
 *         type="number",
 *         description="User Id",
 *         required=true,
 *     ),
 *     @SWG\Parameter(
 *         name="gift_id",
 *         in="query",
 *         type="number",
 *         description="Gift Id",
 *         required=true,
 *     ),
 *     @SWG\Parameter(
 *         name="amount",
 *         in="query",
 *         type="number",
 *         description="Amount gift",
 *         required=true,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Get(
 *     path="/api/v1/points-packages",
 *     description="Points packages list",
 *     summary="Points packages list",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Get(
 *     path="/api/v1/related-links",
 *     description="Related links list",
 *     summary="Related links list",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     @SWG\Parameter(
 *         name="page",
 *         in="query",
 *         type="number",
 *         description="Page",
 *         required=true,
 *     ),
 *     @SWG\Parameter(
 *         name="perpage",
 *         in="query",
 *         type="number",
 *         description="Number of data per page",
 *         required=false,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Get(
 *     path="/api/v1/users/{user_id}/points/history",
 *     description="Get point purchase history",
 *     summary="Get point purchase history",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     @SWG\Parameter(
 *         name="user_id",
 *         in="path",
 *         type="number",
 *         description="User Id",
 *         required=true,
 *     ),
 *     @SWG\Parameter(
 *         name="page",
 *         in="query",
 *         type="number",
 *         description="Page",
 *         required=true,
 *     ),
 *     @SWG\Parameter(
 *         name="keyword",
 *         in="query",
 *         type="string",
 *         description="Purchase date",
 *         required=false,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Post(
 *     path="/api/v1/logout",
 *     description="Logout",
 *     summary="Logout",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     @SWG\Parameter(
 *         name="refresh_token",
 *         in="query",
 *         type="string",
 *         description="Refresh token",
 *         required=true,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Post(
 *     path="/api/v1/points/purchase",
 *     description="Purchase points",
 *     summary="Purchase points",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     @SWG\Parameter(
 *         name="google_receipt",
 *         in="query",
 *         type="string",
 *         description="Response value from Google Play Store",
 *     ),
 *     @SWG\Parameter(
 *         name="apple_receipt",
 *         in="query",
 *         type="string",
 *         description="Response value from App Store or Google Play Store",
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Get(
 *     path="/api/v1/evaluations/history",
 *     description="Get evaluation history",
 *     summary="Get evaluation history",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     @SWG\Parameter(
 *         name="page",
 *         in="query",
 *         type="number",
 *         description="Page",
 *         required=true,
 *     ),
 *     @SWG\Parameter(
 *         name="perpage",
 *         in="query",
 *         type="number",
 *         description="Number of data per page",
 *         required=false,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Get(
 *     path="/api/v1/evaluations/own-books-history",
 *     description="Get own books evaluation history",
 *     summary="Get own books evaluation history",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     @SWG\Parameter(
 *         name="page",
 *         in="query",
 *         type="number",
 *         description="Page",
 *         required=true,
 *     ),
 *     @SWG\Parameter(
 *         name="perpage",
 *         in="query",
 *         type="number",
 *         description="Number of data per page",
 *         required=false,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Post(
 *     path="/api/v1/banks/register",
 *     description="Register bank",
 *     summary="Register bank",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     *@SWG\Parameter(
 *         name="bank_name",
 *         in="query",
 *         type="string",
 *         description="Bank name",
 *         required=false,
 *     ),
 *     @SWG\Parameter(
 *         name="branch_name",
 *         in="query",
 *         type="string",
 *         description="Branch name",
 *         required=false,
 *     ),
 *     @SWG\Parameter(
 *         name="account_number",
 *         in="query",
 *         type="string",
 *         description="Account number",
 *         required=false,
 *     ),
 *     @SWG\Parameter(
 *         name="account_type",
 *         in="query",
 *         type="number",
 *         description="Account type",
 *         required=false,
 *     ),
 *     @SWG\Parameter(
 *         name="account_last_name",
 *         in="query",
 *         type="string",
 *         description="Last name",
 *         required=false,
 *     ),
 *     @SWG\Parameter(
 *         name="account_first_name",
 *         in="query",
 *         type="string",
 *         description="First name",
 *         required=false,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Post(
 *     path="/api/v1/withdrawals",
 *     description="Withdrawal",
 *     summary="Withdrawal",
 *     security={{
 *       "bearerAuth":{}
 *     }},
 *     @SWG\Parameter(
 *         name="amount",
 *         in="query",
 *         type="number",
 *         description="Money",
 *         required=true,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */

/**
 * @SWG\Post(
 *     path="/api/v1/update-profile",
 *     description="Update profile user",
 *     summary="Update profile",
 *     @SWG\Parameter(
 *         name="type",
 *         in="query",
 *         type="number",
 *         description="Type update (1 change password, 2 update profile)",
 *         required=true,
 *     ),
 *     @SWG\Parameter(
 *         name="email",
 *         in="query",
 *         type="string",
 *         description="Your email",
 *         required=false,
 *     ),
 *     @SWG\Parameter(
 *         name="password",
 *         in="query",
 *         type="string",
 *         description="Your password",
 *         required=false,
 *     ),
 *      @SWG\Parameter(
 *         name="old_password",
 *         in="query",
 *         type="string",
 *         description="Your password",
 *         required=false,
 *     ),
 *      @SWG\Parameter(
 *         name="last_name_kanji",
 *         in="query",
 *         type="string",
 *         description="Your last name kanji",
 *         required=false,
 *     ),
 *      @SWG\Parameter(
 *         name="first_name_kanji",
 *         in="query",
 *         type="string",
 *         description="Your first name kanji",
 *         required=false,
 *     ),
 *      @SWG\Parameter(
 *         name="last_name_kana",
 *         in="query",
 *         type="string",
 *         description="Your last name kana",
 *         required=false,
 *     ),
 *      @SWG\Parameter(
 *         name="first_name_kana",
 *         in="query",
 *         type="string",
 *         description="Your first name kana",
 *         required=false,
 *     ),
 *      @SWG\Parameter(
 *         name="phone",
 *         in="query",
 *         type="number",
 *         description="Your phone",
 *         required=false,
 *     ),
 *      @SWG\Parameter(
 *         name="nickname",
 *         in="query",
 *         type="string",
 *         description="Your nickname",
 *         required=false,
 *     ),
 *      @SWG\Parameter(
 *         name="date_of_birth",
 *         in="query",
 *         type="string",
 *         description="Your birthday",
 *         required=false,
 *     ),
 *      @SWG\Parameter(
 *         name="sex",
 *         in="query",
 *         type="number",
 *         description="Your sex",
 *         required=false,
 *     ),
 *      @SWG\Parameter(
 *         name="zip_code",
 *         in="query",
 *         type="string",
 *         description="Your zip code",
 *         required=false,
 *     ),
 *      @SWG\Parameter(
 *         name="city",
 *         in="query",
 *         type="string",
 *         description="Your city",
 *         required=false,
 *     ),
 *      @SWG\Parameter(
 *         name="subsequent_address",
 *         in="query",
 *         type="string",
 *         description="Your subsequent address",
 *         required=false,
 *     ),
 *     @SWG\Response(response="200", description="OK")
 * )
 */
