Prepend CSV header, piping compatible:

```
> cat header-prepend.csv | ./csv-headers-prepend --headers name,age,occupation,location
```

```
> cat header-prepend.csv | ./csv-headers-prepend -h name,age,occupation,location
```

Merge CSVs with inputs/output given as options:

```
> ./csv-merge --input1 merge1.csv --input2 merge2.csv --output1 merged.csv 
```

or with inputs as options and output to STDOUT:

```
> ./csv-merge --input1 merge1.csv --input2 merge2.csv
```

Merge headerless tables, then prepend headers:

```
 ./csv-merge --input1 merge_prepend1.csv --input2 merge_prepend2.csv --ignore-headers | ./csv-headers-prepend --headers name,age,occupation,location
```
