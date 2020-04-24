
<?php if ($preSave):?>
    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (null !== $con
            && method_exists($con, 'getEventDispatcher')
            && null !== $con->getEventDispatcher()
        ) {
            $event = new <?php echo $eventClass ?>($this);

            $con->getEventDispatcher()
                ->dispatch(
                    <?php echo $eventClass ?>::PRE_SAVE,
                    $event
                );

            return !$event->isPropagationStopped();
        }

        return true;
    }

<?php endif?>
<?php if ($postSave):?>
    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (null !== $con
            && method_exists($con, 'getEventDispatcher')
            && null !== $con->getEventDispatcher()
        ) {
            $con->getEventDispatcher()
                ->dispatch(
                    <?php echo $eventClass ?>::POST_SAVE,
                    new <?php echo $eventClass ?>($this)
                );
        }
    }

<?php endif?>
<?php if ($preInsert):?>
    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (null !== $con
            && method_exists($con, 'getEventDispatcher')
            && null !== $con->getEventDispatcher()
        ) {
            $event = new <?php echo $eventClass ?>($this);
            $con->getEventDispatcher()
                ->dispatch(
                    <?php echo $eventClass ?>::PRE_INSERT,
                    $event
                );

            return !$event->isPropagationStopped();
        }

        return true;
    }

<?php endif?>
<?php if ($postInsert):?>
    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (null !== $con
            && method_exists($con, 'getEventDispatcher')
            && null !== $con->getEventDispatcher()
        ) {
            $con->getEventDispatcher()
                ->dispatch(
                    <?php echo $eventClass ?>::POST_INSERT,
                    new <?php echo $eventClass ?>($this)
                );
        }
    }

<?php endif?>
<?php if ($preUpdate):?>
    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (null !== $con
            && method_exists($con, 'getEventDispatcher')
            && null !== $con->getEventDispatcher()
        ) {
            $event = new <?php echo $eventClass ?>($this);

            $con->getEventDispatcher()
                ->dispatch(
                    <?php echo $eventClass ?>::PRE_UPDATE,
                    $event
                );

            return !$event->isPropagationStopped();
        }

        return true;
    }

<?php endif?>
<?php if ($postUpdate):?>
    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (null !== $con
            && method_exists($con, 'getEventDispatcher')
            && null !== $con->getEventDispatcher()
        ) {
            $con->getEventDispatcher()
                ->dispatch(
                    <?php echo $eventClass ?>::POST_UPDATE,
                    new <?php echo $eventClass ?>($this)
                );
        }
    }

<?php endif?>
<?php if ($preDelete):?>
    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (null !== $con
            && method_exists($con, 'getEventDispatcher')
            && null !== $con->getEventDispatcher()
        ) {
            $event = new <?php echo $eventClass ?>($this);

            $con->getEventDispatcher()
                ->dispatch(
                    <?php echo $eventClass ?>::PRE_DELETE,
                    $event
                );

            return !$event->isPropagationStopped();
        }

        return true;
    }

<?php endif?>
<?php if ($postDelete):?>
    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (null !== $con
            && method_exists($con, 'getEventDispatcher')
            && null !== $con->getEventDispatcher()
        ) {
            $con->getEventDispatcher()
                ->dispatch(
                    <?php echo $eventClass ?>::POST_DELETE,
                    new <?php echo $eventClass ?>($this)
                );
        }
    }

<?php endif?>