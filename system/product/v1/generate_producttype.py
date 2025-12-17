import random

# Generate SQL insert values
rows = []
for product_id in range(1, 1001):
    type_id = random.randint(1, 7)
    active = random.choice([0, 1])
    rows.append(f"({product_id}, {type_id}, {active})")

# Format into SQL insert statement
insert_sql = (
    "INSERT INTO producttype (productId, typeId, active) VALUES\n"
    + ",\n".join(rows) + ";"
)

# Save to file
with open("producttype.sql", "w") as f:
    f.write(insert_sql)

print("SQL data for 'producttype' mapping generated in producttype.sql.")
