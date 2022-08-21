<?php
// Voraussetzung (in php.ini): extension=php_sqlite3.dll
$GLOBALS["sessions_db"] = "sessions.db";

function erzeugeDB() {
    $db = new SQLite3($GLOBALS["sessions_db"]);
    $ergebnis = $db->query("CREATE TABLE sessiondaten (id VARCHAR(32) PRIMARY KEY, daten TEXT, zugriff VARCHAR(14))");
    $db->close();
}

function zeitstempel() {
    return date("YmdHis");
}

function _open($pfad, $name) {
    if (!file_exists($GLOBALS["sessions_db"])) {
        erzeugeDB();
    }
    $GLOBALS["sessions_id"] = new SQLite3($GLOBALS["sessions_db"]);
    return true;
}

function _close() {
    $GLOBALS["sessions_id"]->close();
    unset($GLOBALS["sessions_id"]);
    return true;
}

function _read($sessionid) {
    if (!isset($GLOBALS["sessions_id"])) {
        _open('', '');
    }
    $ergebnis = $GLOBALS["sessions_id"]->query("SELECT daten FROM sessiondaten WHERE id='$sessionid'");
    $zeile = $ergebnis->fetchArray();
    if ($zeile) {
        $wert = $zeile["daten"];
        $sessionid = $GLOBALS["sessions_id"]->escapeString($sessionid);
        $GLOBALS["sessions_id"]->query("UPDATE sessiondaten SET zugriff='" . zeitstempel() . "' WHERE id='$sessionid'");
    } else {
        $wert = "";
    }
    return $wert;
}

function _write($sessionid, $daten) {
    if (!isset($GLOBALS["sessions_id"])) {
        _open('', '');
    }
    $daten = $GLOBALS["sessions_id"]->escapeString($daten);
    $sessionid = $GLOBALS["sessions_id"]->escapeString($sessionid);
    $ergebnis = $GLOBALS["sessions_id"]->query("UPDATE sessiondaten SET daten='" . $daten . "', zugriff='" . zeitstempel() . "' WHERE id='$sessionid'");
    if ($GLOBALS["sessions_id"]->changes() == 0) {
        $GLOBALS["sessions_id"]->query("INSERT INTO sessiondaten (id, daten, zugriff) VALUES ('$sessionid', '" . $daten . "', '" . zeitstempel() . "')");
    }
    return true;
}

function _destroy($sessionid) {
    $sessionid = $GLOBALS["sessions_id"]->escapeString($sessionid);
    $GLOBALS["sessions_id"]->query("DELETE FROM sessiondaten WHERE id='$sessionid'");
    return true;
}

function _gc($lebensdauer) {
    $ablauf = time() - $lebensdauer;
    $ablauf_zeitstempel = date("YmdHis", $ablauf);
    $GLOBALS["sessions_id"]->query("DELETE FROM sessiondaten WHERE zugriff < '$ablauf_zeitstempel'");
    return true;
}

session_set_save_handler("_open", "_close", "_read", "_write", "_destroy", "_gc");
register_shutdown_function("session_write_close");
session_start();
?>
