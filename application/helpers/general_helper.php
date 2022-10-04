<?php

function getUserLogin()
{
	if (@$_SESSION['nip']) {
		return $_SESSION;
	}

	return NULL;

}