Prepend CSV header, piping compatible:

```
> cat csv/header-prepend.csv | ./csv-headers-prepend --headers name,age,occupation,location
```

```
> cat csv/header-prepend.csv | ./csv-headers-prepend -h name,age,occupation,location
```

Merge CSVs with inputs/output given as options:

```
> ./csv-merge --input1 csv/merge1.csv --input2 csv/merge2.csv --output1 merged.csv 
```

or with inputs as options and output to STDOUT:

```
> ./csv-merge --input1 csv/merge1.csv --input2 csv/merge2.csv
```

Merge headerless tables, then prepend headers:

```
 ./csv-merge --input1 csv/merge_prepend1.csv --input2 csv/merge_prepend2.csv --ignore-headers | ./csv-headers-prepend --headers name,age,occupation,location
```


For generating PEM keys, you would use:
```
openssl genpkey -algorithm RSA -out private_key.pem -pkeyopt rsa_keygen_bits:2048
openssl rsa -pubout -in private_key.pem -out public_key.pem
```
But they are already provided in `keys` dir.

To sign a CSV file column:
```
cat csv/to_sign.csv | ./csv-column-sign -c grade -k 'keys/private_key.pem' > signed.csv
```
Then, without altering signed.csv:
```
cat signed.csv | ./csv-column-sign-verify -c grade -k 'keys/public_key.pem'
```
The out will be the original CSV data, just as `to_sign.csv`.


But if the contents of the `grade` column of the rows in `signed.csv` is altered and:
```
cat signed.csv | ./csv-column-sign-verify -c grade -k 'keys/public_key.pem'
```
Will output something such as:
```
Invalid signature for row Dan, 38, Cluj-Napoca, 9.6, TK1flz7qR4ImowrWqQTk3SgEJL7Ptwz9edpS6s0
6qUSABpLbdEXeGUo/wzsWe2HkxsF5HHNVjV6klOAJus0I0Qki+8FXV1X1KuNztav3kx+nXn4kt3S+MhFIWVj4AKWDmEY
TGUdwe7ptVjzOHYWYLbLIpLqhEzU3dceKt51IUJa+WtIUD7fV0xQHYI/VVbvgQFNMGRpZzoaNzs4Xi7uNX7qWyOn9/f0
SyztvcXkkH+nUKHCHEIQqd9N6857h4+lYpVDg0YhP3+1twzYFgfg0AMF9G3U/vEkGFLYgKzO+Pn2Gm6VgW0Jt7MYeW7TgUdqz3EzXa6Yw1i10pnnlFGCuoA==
```