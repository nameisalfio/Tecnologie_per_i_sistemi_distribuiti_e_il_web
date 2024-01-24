package com.example.Magazine.repositories;

import org.springframework.data.jpa.repository.JpaRepository;
import com.example.Magazine.models.Product;
import java.util.List;

public interface ProductRepository extends JpaRepository<Product, Long> {

    List<Product> findByGiacenzaGreaterThan(Integer giacenza);

    default void decreaseAllPrices(Integer percentage) {
        findAll().stream()
                 .forEach(p -> {
                    p.setPrezzo(p.getPrezzo() * (1 - percentage/100.0));
                    this.save(p);
                 });
    }
    
    
    default void decreaseStock(Long id) {
        Product product = this.findById(id).get();
        product.setGiacenza(product.getGiacenza() - 1);
        this.save(product);
    }
}
