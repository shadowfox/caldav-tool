<?php
/**
 * Represents a CalDAV account which can have one or many calendars
 */
class Account extends Model {
    public function calendars() {
        return $this->hasMany('Calendar');
    }

    public function serverType() {
        if (strpos($this->server_uri, 'icloud') !== false) {
            return 'icloud';
        } else if (strpos($this->server_uri, 'google') !== false) {
            return 'google';
        } else {
            return 'generic';
        }
    }

    public function getBasicAuthString() {
        return base64_encode($this->username . ':' . $this->password);
    }

    public function __toString() {
        return sprintf('Account[id=%s, server=%s, uri=%s, username=%s]',
            $this->id, $this->server, $this->uri, $this->username);
    }
}