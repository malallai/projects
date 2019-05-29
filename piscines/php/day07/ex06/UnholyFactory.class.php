<?php


class UnholyFactory {

    private $fighters = array();

    public function absorb($type) {
        if ($type instanceof Fighter) {
            if (array_key_exists($type->getName(), $this->fighters)) {
                printf ("(Factory already absorbed a fighter of type %s)\n", $type->getName());
            } else {
                $this->fighters[$type->getName()] = $type;
                printf ("(Factory absorbed a fighter of type %s)\n", $type->getName());
            }
        } else {
            printf ("(Factory can't absorb this, it's not a fighter)\n");
        }
    }

    public function fabricate($type) {
        if (array_key_exists($type, $this->fighters)) {
            printf ("(Factory fabricates a fighter of type %s)\n", $type);
            return (clone($this->fighters[$type]));
        } else {
            printf ("(Factory hasn't absorbed any fighter of type %s)\n", $type);
            return null;
        }
    }

}