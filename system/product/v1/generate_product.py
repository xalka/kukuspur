import random
import faker
from datetime import datetime

fake = faker.Faker()

# Farming-related product keywords
farming_products = [
    "Organic Chicken Feed", "Dairy Cattle Mineral Mix", "Goat Dewormer", "Poultry Booster", "Herbal Livestock Tonic",
    "ECF Vaccine", "Cattle Tick Spray", "Poultry Vitamin Mix", "Sheep Antibiotic Injection", "Pig Growth Promoter",
    "Milking Salve", "Cattle Hormone Injection", "Livestock Disinfectant", "Pet Deworming Syrup", "Aquaculture Feed",
    "Fertilizer NPK", "Soil Conditioner", "Foliar Spray", "Silage Inoculant", "Insecticide Concentrate",
    "Organic Compost", "Seedling Booster", "Crop Fungicide", "Animal Feed Additive", "Tractor Engine Oil"
]

# Clean text to avoid SQL injection or problematic characters
def clean(text):
    return text.replace("'", "").replace('"', '').strip()

# Generate simplified SQL for farming products
def generate_farming_products(n=100):
    products = []
    for _ in range(n):
        name = clean(random.choice(farming_products)) + f" {random.randint(100, 999)}"
        descrp = clean(fake.sentence(nb_words=8))
        categoryId = random.randint(1, 25)  # Assuming category IDs 1–25 exist
        sku = f"SKU{random.randint(10000, 99999)}"
        adminId = 1  # Set a fixed adminId or remove if not needed
        active = random.choice(['1', '0'])
        price = round(random.uniform(5, 5000), 2)
        products.append((name, descrp, categoryId, sku, adminId, active, price))
    return products

# Generate products
farming_products_data = generate_farming_products(1000)

# Format SQL INSERT values safely
sql_values = ",\n".join([
    f"('{p[0]}', '{p[1]}', {p[2]}, '{p[3]}', {p[4]}, '{p[5]}', {p[6]})"
    for p in farming_products_data
])

# Complete SQL statement
insert_sql = f"INSERT INTO product (product, descrp, categoryId, sku, adminId, active, price) VALUES\n{sql_values};"

# Write SQL to file
with open('products.sql', 'w', encoding='utf-8') as f:
    f.write(insert_sql)

# Optional confirmation message
print("SQL file generated successfully: products.sql")