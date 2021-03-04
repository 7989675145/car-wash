car wash

1)login
id(pk)
phone
pass

2)user_details
id(fk)
name
status(0)

3)washes
wash_id()
car_type(pk)
wash_type(pk)
price

4)vehicle
id(fk)
number
car_type(pk)
wash_type(fk)
booking_slot

5)booking
id(fk)
slot1
slot2