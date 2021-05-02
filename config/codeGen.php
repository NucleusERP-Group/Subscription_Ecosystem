<?php
/*
 * Created on Sat May 01 2021
 *
 * The MIT License (MIT)
 * Copyright (c) 2021 MartDevelopers Inc
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial
 * portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
 * TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

//---------Password Reset Token generator -------------------------------------------//
$length = 30;
$tk = substr(str_shuffle("QWERTYUIOPLKJHGFDSAZXCVBNM1234567890"), 1, $length);

//------------Dummy Password Generator----------------------------------------------//
$length = 8;
$rc = substr(str_shuffle("QWERTYUIOPLKJHGFDSAZXCVBNM1234567890"), 1, $length);

// ------- ID--------------------------------------------------------------------//
$length = date('y');
$ID = bin2hex(random_bytes($length));

// ------- Checksum--------------------------------------------------------------------//
$length = 12;
$checksum = bin2hex(random_bytes($length));

// ---System Generated Codes----------------------------------------------------------------//
$alpha = 5;
$beta = 5;
$a = substr(str_shuffle("QWERTYUIOPLKJHGFDSAZXCVBNM1234567890"), 1, $alpha);
$b = substr(str_shuffle("1234567890"), 1, $beta);

$alpha = 10;
$paycode = substr(str_shuffle("QWERTYUIOPLKJHGFDSAZXCVBNM1234567890"), 1, $alpha);

/* System Admin Default Password */
$length = 8;
$defaultPass = substr(str_shuffle("QWERTYUIOPwertyuioplkjLKJHGFDSAZXCVBNM1234567890qhgfdsazxcvbnm"), 1, $length);
