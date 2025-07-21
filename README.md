## Booking Core

| Table                          | Time Fields     | Reason                                   |
| ------------------------------ | --------------- | ---------------------------------------- |
| `bookings`                     | `date`          | Precise time range for real appointments |
| `provider_schedules`           | `time`          | Weekly recurring hours                   |
| `provider_schedule_exceptions` | `date`          | Per-day override of recurring schedule   |
| `provider_schedule_groups`     | `date`          | Defines schedule validity range          |
