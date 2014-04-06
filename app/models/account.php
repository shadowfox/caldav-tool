<?php
/**
 * Represents a CalDAV account which can have one or many calendars
 */
class Account extends Model {
    public function calendars() {
        return $this->hasMany('Calendar');
    }

    /**
     * Looks at the server URI and attempts to guess the service in use
     * 
     * @return string A short name of the server in use
     */
    public function serverType() {
        if (strpos($this->server_uri, 'icloud') !== false) {
            return 'icloud';
        } else if (strpos($this->server_uri, 'google') !== false) {
            return 'google';
        } else {
            return 'generic';
        }
    }

    /**
     * Combine the username and password into a string for HTTP basic/digest authentication
     *
     * @return string A base64 HTTP auth string
     */
    public function getBasicAuthString() {
        return base64_encode($this->username . ':' . $this->password);
    }

    /**
     * Save an account record
     */
    public function save() {
        if (empty($this->server_uri) || empty($this->username) || empty($this->password)) {
            return false;
        }

        // We usually expect email addresses as usernames,
        // so we'll slugify the first part only for the ID.
        // The input remains intact if it doesn't contain an @ charater
        $id = explode('@', $this->username);
        $this->id = \AppUtils\slugify($id[0]);
        
        return parent::save();
    }

    public function __toString() {
        return sprintf('Account[id=%s, server_uri=%s, username=%s]',
            $this->id, $this->server_uri, $this->username);
    }
}