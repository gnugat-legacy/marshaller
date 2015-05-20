# Changes between versions

## 1.1.0: Collection conversion

* `Marshaller` can iterate over collections and call the appropriate `MarshallerStrategy` for each element

## 1.0.0: Generic conversion

* `Marshaller` executes the appropriate `MarshallerStrategy`
* Fine grained `MarshallerStrategy` support through categories
* priorization of `MarshallerStrategy` when registering it in `Marshaller`
