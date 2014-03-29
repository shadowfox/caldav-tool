<?php
/**
 * Represents access information for a CalDAV calendar
 */
class Calendar extends Model {
    public function account() {
        return $this->hasOne('Account');
    }

    public function __toString() {
        return sprintf('Calendar[id=%s, account_id=%s, name=%s, uri=%s]',
            $this->id, $this->account_id, $this->name, $this->uri);
    }
}