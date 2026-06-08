<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BeautyGlowSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Skin Care',
                'description' => 'Hydrating formulas crafted for every skin type and routine.',
            ],
            [
                'name' => 'Makeup',
                'description' => 'Glow-ready cosmetics for luminous skin, eyes, and lips.',
            ],
            [
                'name' => 'Hair Care',
                'description' => 'Nourishing rituals to strengthen, soften, and revive your hair.',
            ],
        ];

        foreach ($categories as $categoryData) {
            $category = Category::firstOrCreate([
                'name' => $categoryData['name'],
            ], [
                'slug' => Str::slug($categoryData['name']),
                'description' => $categoryData['description'],
            ]);

            $this->seedProductsForCategory($category);
        }
    }

    private function seedProductsForCategory(Category $category): void
    {
        $productsByCategory = [
            'Skin Care' => [
                [
                    'name' => 'Glow Dew Serum',
                    'short_description' => 'Lightweight hydration for glowing, even skin.',
                    'description' => 'A fast-absorbing serum with hyaluronic acid and niacinamide to restore radiance and calm irritation.',
                    'ingredients' => ['Hyaluronic acid', 'Niacinamide', 'Green tea extract'],
                    'benefits' => ['Deeply hydrates', 'Brightens complexion', 'Smooths fine lines'],
                    'base_price' => 34.00,
                    'featured' => true,
                    'active' => true,
                    'image' => 'https://placehold.co/500x600/F9E8E8/8B5A65?text=Glow+Dew+Serum',
                    'variants' => [
                        ['name' => '30ml', 'sku' => 'SGLOW-30', 'price' => 34.00, 'stock' => 24],
                        ['name' => '50ml', 'sku' => 'SGLOW-50', 'price' => 48.00, 'stock' => 15],
                    ],
                ],
                [
                    'name' => 'Velvet Overnight Mask',
                    'short_description' => 'Wake up to softer, smoother skin.',
                    'description' => 'A nourishing overnight mask that seals in moisture and refines texture while you sleep.',
                    'ingredients' => ['Ceramides', 'Peptides', 'Squalane', 'Shea butter'],
                    'benefits' => ['Deeply plumps', 'Repairs barrier', 'Softens texture'],
                    'base_price' => 28.00,
                    'featured' => true,
                    'active' => true,
                    'image' => 'https://placehold.co/500x600/E8F0FE/5A6B8B?text=Overnight+Mask',
                    'variants' => [
                        ['name' => '50ml', 'sku' => 'SMASK-50', 'price' => 28.00, 'stock' => 18],
                        ['name' => '100ml', 'sku' => 'SMASK-100', 'price' => 42.00, 'stock' => 10],
                    ],
                ],
                [
                    'name' => 'Radiant Essence Toner',
                    'short_description' => 'Gentle toning for balanced, glowing skin.',
                    'description' => 'A soothing essence toner with botanical extracts to refine pores and restore hydration.',
                    'ingredients' => ['Aloe vera', 'Rice water extract', 'Chamomile', 'Panthenol'],
                    'benefits' => ['Balances pH', 'Soothes irritation', 'Prepares skin'],
                    'base_price' => 22.00,
                    'featured' => false,
                    'active' => true,
                    'image' => 'https://placehold.co/500x600/E8FEEE/5A8B6A?text=Essence+Toner',
                    'variants' => [
                        ['name' => '150ml', 'sku' => 'STONER-150', 'price' => 22.00, 'stock' => 20],
                        ['name' => '300ml', 'sku' => 'STONER-300', 'price' => 35.00, 'stock' => 12],
                    ],
                ],
                [
                    'name' => 'Vitamin C Brightening Eye Cream',
                    'short_description' => 'Brighten and firm the delicate eye area.',
                    'description' => 'A lightweight eye cream infused with Vitamin C and caffeine to reduce dark circles and puffiness.',
                    'ingredients' => ['Vitamin C', 'Caffeine', 'Hyaluronic acid', 'Peptides'],
                    'benefits' => ['Brightens dark circles', 'Reduces puffiness', 'Firms skin'],
                    'base_price' => 32.00,
                    'featured' => true,
                    'active' => true,
                    'image' => 'https://placehold.co/500x600/FEF8E8/C9A96E?text=Eye+Cream',
                    'variants' => [
                        ['name' => '15ml', 'sku' => 'SEYE-15', 'price' => 32.00, 'stock' => 22],
                    ],
                ],
                [
                    'name' => 'Retinol Renewal Night Cream',
                    'short_description' => 'Advanced anti-aging night treatment.',
                    'description' => 'A powerful yet gentle retinol cream that smooths wrinkles and improves skin elasticity overnight.',
                    'ingredients' => ['Retinol', 'Bakuchiol', 'Vitamin E', 'Ceramides'],
                    'benefits' => ['Reduces wrinkles', 'Improves elasticity', 'Even skin tone'],
                    'base_price' => 45.00,
                    'featured' => false,
                    'active' => true,
                    'image' => 'https://placehold.co/500x600/F0E0EF/8B5A7B?text=Retinol+Cream',
                    'variants' => [
                        ['name' => '50ml', 'sku' => 'SRET-50', 'price' => 45.00, 'stock' => 14],
                    ],
                ],
                [
                    'name' => 'Hydrating Bubble Foam Cleanser',
                    'short_description' => 'Gentle daily cleansing with rich foam.',
                    'description' => 'A pH-balanced foam cleanser that removes impurities without stripping the skin barrier.',
                    'ingredients' => ['Amino acids', 'Glycerin', 'Green tea', 'Centella asiatica'],
                    'benefits' => ['Gentle cleansing', 'Maintains moisture', 'Soothes skin'],
                    'base_price' => 18.00,
                    'featured' => false,
                    'active' => true,
                    'image' => 'https://placehold.co/500x600/FDE8EC/C98A8A?text=Foam+Cleanser',
                    'variants' => [
                        ['name' => '120ml', 'sku' => 'SCLEAN-120', 'price' => 18.00, 'stock' => 30],
                        ['name' => '200ml', 'sku' => 'SCLEAN-200', 'price' => 26.00, 'stock' => 18],
                    ],
                ],
            ],
            'Makeup' => [
                [
                    'name' => 'Luminous Cushion Tint',
                    'short_description' => 'A fresh, glowing base for everyday wear.',
                    'description' => 'Buildable coverage with a luminous finish that feels weightless and natural all day.',
                    'ingredients' => ['Vitamin E', 'Glycerin', 'Mineral pigments', 'Niacinamide'],
                    'benefits' => ['Buildable coverage', 'Dewy finish', 'Hydrates skin'],
                    'base_price' => 36.00,
                    'featured' => true,
                    'active' => true,
                    'image' => 'https://placehold.co/500x600/F8D4DC/C98A8A?text=Cushion+Tint',
                    'variants' => [
                        ['name' => 'Shade Light', 'sku' => 'MMU-QL1', 'price' => 36.00, 'stock' => 26],
                        ['name' => 'Shade Medium', 'sku' => 'MMU-QM1', 'price' => 36.00, 'stock' => 22],
                        ['name' => 'Shade Deep', 'sku' => 'MMU-QD1', 'price' => 36.00, 'stock' => 18],
                    ],
                ],
                [
                    'name' => 'Velvet Blush Stick',
                    'short_description' => 'Creamy blush for buildable color.',
                    'description' => 'A creamy, blendable blush stick that delivers a luminous flush with a skin-like finish.',
                    'ingredients' => ['Murumuru butter', 'Jojoba oil', 'Vitamin C', 'Rosehip oil'],
                    'benefits' => ['Blends easily', 'Buildable color', 'Hydrates cheeks'],
                    'base_price' => 21.00,
                    'featured' => false,
                    'active' => true,
                    'image' => 'https://placehold.co/500x600/FCE8E8/E8B4B8?text=Blush+Stick',
                    'variants' => [
                        ['name' => 'Peach Glow', 'sku' => 'MBLUSH-PE', 'price' => 21.00, 'stock' => 24],
                        ['name' => 'Rose Petal', 'sku' => 'MBLUSH-RO', 'price' => 21.00, 'stock' => 20],
                    ],
                ],
                [
                    'name' => 'Silk Lip Tint',
                    'short_description' => 'Soft, buildable tint with lasting comfort.',
                    'description' => 'A silky lip tint with a luminous color payoff and comfortable wear throughout the day.',
                    'ingredients' => ['Shea butter', 'Jojoba oil', 'Rice bran oil', 'Vitamin E'],
                    'benefits' => ['Comfortable wear', 'Long-lasting color', 'Soft finish'],
                    'base_price' => 18.00,
                    'featured' => false,
                    'active' => true,
                    'image' => 'https://placehold.co/500x600/F0D0D8/C98A7A?text=Lip+Tint',
                    'variants' => [
                        ['name' => 'Pink Bloom', 'sku' => 'MLIP-PI', 'price' => 18.00, 'stock' => 28],
                        ['name' => 'Coral Dream', 'sku' => 'MLIP-CO', 'price' => 18.00, 'stock' => 25],
                        ['name' => 'Berry Glow', 'sku' => 'MLIP-BE', 'price' => 18.00, 'stock' => 22],
                    ],
                ],
                [
                    'name' => 'Glow Highlighter Drops',
                    'short_description' => 'Liquid highlighter for a natural glow.',
                    'description' => 'Liquid highlighter drops that blend seamlessly for a dewy, lit-from-within radiance.',
                    'ingredients' => ['Mica', 'Vitamin E', 'Glycerin', 'Pearl extract'],
                    'benefits' => ['Natural glow', 'Blends seamlessly', 'Buildable intensity'],
                    'base_price' => 26.00,
                    'featured' => true,
                    'active' => true,
                    'image' => 'https://placehold.co/500x600/FEF0E0/C9A96E?text=Highlighter',
                    'variants' => [
                        ['name' => 'Champagne Pop', 'sku' => 'MHIGH-CH', 'price' => 26.00, 'stock' => 20],
                        ['name' => 'Rose Gold', 'sku' => 'MHIGH-RO', 'price' => 26.00, 'stock' => 18],
                    ],
                ],
                [
                    'name' => 'Natural Eyebrow Pencil',
                    'short_description' => 'Precision eyebrow pencil with spoolie.',
                    'description' => 'A fine-tip eyebrow pencil that creates natural-looking hair strokes with long-lasting wear.',
                    'ingredients' => ['Coconut oil', 'Carnauba wax', 'Vitamin E', 'Mineral pigments'],
                    'benefits' => ['Natural strokes', 'Long-lasting', 'Easy blend'],
                    'base_price' => 14.00,
                    'featured' => false,
                    'active' => true,
                    'image' => 'https://placehold.co/500x600/F0E8D8/8B7A5A?text=Brow+Pencil',
                    'variants' => [
                        ['name' => 'Ash Brown', 'sku' => 'MBROW-AB', 'price' => 14.00, 'stock' => 30],
                        ['name' => 'Soft Black', 'sku' => 'MBROW-SB', 'price' => 14.00, 'stock' => 28],
                    ],
                ],
                [
                    'name' => 'Volumizing Mascara',
                    'short_description' => 'Dramatic volume without clumping.',
                    'description' => 'A volumizing mascara with a curved brush that lifts and separates lashes for a wide-eyed look.',
                    'ingredients' => ['Beeswax', 'Panthenol', 'Keratin', 'Natural fibers'],
                    'benefits' => ['Dramatic volume', 'Lifts lashes', 'Smudge-proof'],
                    'base_price' => 22.00,
                    'featured' => true,
                    'active' => true,
                    'image' => 'https://placehold.co/500x600/E8E8FC/7A6A8B?text=Mascara',
                    'variants' => [
                        ['name' => 'Black', 'sku' => 'MMASC-BK', 'price' => 22.00, 'stock' => 32],
                    ],
                ],
            ],
            'Hair Care' => [
                [
                    'name' => 'Silk Repair Shampoo',
                    'short_description' => 'Gentle cleansing for smooth, shiny hair.',
                    'description' => 'A repairing shampoo that cleanses without stripping, while strengthening dry and damaged strands.',
                    'ingredients' => ['Keratin', 'Argan oil', 'Rice protein', 'Biotin'],
                    'benefits' => ['Gently cleanses', 'Repairs damage', 'Adds shine'],
                    'base_price' => 24.00,
                    'featured' => true,
                    'active' => true,
                    'image' => 'https://placehold.co/500x600/F0F8FE/5A7A9A?text=Repair+Shampoo',
                    'variants' => [
                        ['name' => '250ml', 'sku' => 'HSHAMP-250', 'price' => 24.00, 'stock' => 22],
                        ['name' => '500ml', 'sku' => 'HSHAMP-500', 'price' => 38.00, 'stock' => 14],
                    ],
                ],
                [
                    'name' => 'Nourishing Hair Mask',
                    'short_description' => 'Deep conditioning for soft, healthier hair.',
                    'description' => 'A rich mask designed to restore moisture, reduce frizz, and strengthen brittle ends.',
                    'ingredients' => ['Shea butter', 'Oat extract', 'Marula oil', 'Honey'],
                    'benefits' => ['Deeply conditions', 'Reduces frizz', 'Strengthens hair'],
                    'base_price' => 29.00,
                    'featured' => false,
                    'active' => true,
                    'image' => 'https://placehold.co/500x600/FEF8E8/D9B96E?text=Hair+Mask',
                    'variants' => [
                        ['name' => '200ml', 'sku' => 'HMASK-200', 'price' => 29.00, 'stock' => 20],
                        ['name' => '400ml', 'sku' => 'HMASK-400', 'price' => 45.00, 'stock' => 10],
                    ],
                ],
                [
                    'name' => 'Gloss Finish Serum',
                    'short_description' => 'Lightweight shine for polished hair.',
                    'description' => 'A smoothing serum that adds glossy finish and tames flyaways without weighing hair down.',
                    'ingredients' => ['Camellia oil', 'Vitamin B5', 'Silk proteins', 'Argan oil'],
                    'benefits' => ['Adds brilliant shine', 'Tames flyaways', 'Frizz control'],
                    'base_price' => 19.00,
                    'featured' => false,
                    'active' => true,
                    'image' => 'https://placehold.co/500x600/F8F0EC/B8A090?text=Hair+Serum',
                    'variants' => [
                        ['name' => '30ml', 'sku' => 'HSERUM-30', 'price' => 19.00, 'stock' => 26],
                        ['name' => '50ml', 'sku' => 'HSERUM-50', 'price' => 28.00, 'stock' => 18],
                    ],
                ],
                [
                    'name' => 'Volumizing Root Spray',
                    'short_description' => 'Instant volume at the roots.',
                    'description' => 'A lightweight volumizing spray that lifts roots and adds body without sticky residue.',
                    'ingredients' => ['Rice protein', 'Sea salt', 'Aloe vera', 'Panthenol'],
                    'benefits' => ['Instant volume', 'Lifts roots', 'No stickiness'],
                    'base_price' => 16.00,
                    'featured' => true,
                    'active' => true,
                    'image' => 'https://placehold.co/500x600/E8FEEE/6A9A7A?text=Root+Spray',
                    'variants' => [
                        ['name' => '150ml', 'sku' => 'HVOL-150', 'price' => 16.00, 'stock' => 24],
                    ],
                ],
                [
                    'name' => 'Color Protect Conditioner',
                    'short_description' => 'Preserves color while nourishing hair.',
                    'description' => 'A color-safe conditioner that seals cuticles and protects against fading while adding silky softness.',
                    'ingredients' => ['Sunflower seed oil', 'Vitamin E', 'UV filters', 'Keratin'],
                    'benefits' => ['Protects color', 'Seals cuticles', 'Adds softness'],
                    'base_price' => 26.00,
                    'featured' => false,
                    'active' => true,
                    'image' => 'https://placehold.co/500x600/F0E0F8/8A6A9A?text=Color+Conditioner',
                    'variants' => [
                        ['name' => '250ml', 'sku' => 'HCOND-250', 'price' => 26.00, 'stock' => 20],
                    ],
                ],
                [
                    'name' => 'Scalp Refresh Toner',
                    'short_description' => 'Cooling treatment for a healthy scalp.',
                    'description' => 'A refreshing scalp toner with tea tree and peppermint to soothe irritation and promote healthy hair growth.',
                    'ingredients' => ['Tea tree oil', 'Peppermint oil', 'Salicylic acid', 'Zinc PCA'],
                    'benefits' => ['Soothes scalp', 'Reduces dandruff', 'Promotes growth'],
                    'base_price' => 20.00,
                    'featured' => false,
                    'active' => true,
                    'image' => 'https://placehold.co/500x600/D8F0F8/5A8A9A?text=Scalp+Toner',
                    'variants' => [
                        ['name' => '120ml', 'sku' => 'HSCALP-120', 'price' => 20.00, 'stock' => 22],
                    ],
                ],
            ],
        ];

        $products = $productsByCategory[$category->name] ?? [];

        foreach ($products as $productData) {
            $product = Product::firstOrCreate(
                [
                    'category_id' => $category->id,
                    'name' => $productData['name'],
                ],
                [
                    'slug' => Str::slug($productData['name']),
                    'short_description' => $productData['short_description'],
                    'description' => $productData['description'],
                    'ingredients' => $productData['ingredients'],
                    'benefits' => $productData['benefits'],
                    'base_price' => $productData['base_price'],
                    'featured' => $productData['featured'],
                    'active' => $productData['active'],
                ]
            );

            ProductImage::firstOrCreate([
                'product_id' => $product->id,
                'url' => $productData['image'],
            ], [
                'alt_text' => $productData['name'],
                'is_primary' => true,
            ]);

            foreach ($productData['variants'] as $variantData) {
                ProductVariant::firstOrCreate(
                    [
                        'product_id' => $product->id,
                        'name' => $variantData['name'],
                    ],
                    [
                        'sku' => $variantData['sku'],
                        'price' => $variantData['price'],
                        'stock' => $variantData['stock'],
                        'available' => true,
                    ]
                );
            }
        }
    }
}