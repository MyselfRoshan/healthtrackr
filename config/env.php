<?php
const APP_NAME = "healthtrackr";

const SERVER_HOST = "http://localhost";
const SERVER_PORT = "8000";
const SERVER_URL = SERVER_HOST . ":" . SERVER_PORT;

const DB = "postgres";
const DB_HOST = "localhost";
const DB_PORT = "3306";
const DB_NAME = APP_NAME . "_db";
const DB_USERNAME = "root";
const DB_PASSWORD = "ht_db";
const DB_CHARSET = "utf8mb4";

const ACCESS_TOKEN_SECRET = "mksecret6X9b2023PcemhSt03Pty13S389CT9FDCbbKwaccess";
const ACCESS_TOKEN_EXPIRES_AFTER = 43200; // in seconds
const REFRESH_TOKEN_SECRET = "mksecret6X9b2023PcemhSt03Pty13S389CT9FDCbbKwrefresh";
const REFRESH_TOKEN_EXPIRES_AFTER = 86400; // in seconds
