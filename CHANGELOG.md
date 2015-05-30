# Changes between versions

## 2.0.0: Collection conversion

* added `Marshaller#marshalCollection`

> **Note**: BC break, `Marshaller#marshal` no longer iterate over `arrays` or `Traversable`
> to allow marshalling from `array`. Use `Marshaller#marshalCollection` instead.

## 1.1.0: Collection conversion

* `Marshaller` can iterate over collections and call the appropriate `MarshallerStrategy` for each element

## 1.0.0: Generic conversion

* `Marshaller` executes the appropriate `MarshallerStrategy`
* Fine grained `MarshallerStrategy` support through categories
* priorization of `MarshallerStrategy` when registering it in `Marshaller`
