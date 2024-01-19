package com.example.Magazine.repositories;

import org.springframework.data.jpa.repository.JpaRepository;
import com.example.Magazine.models.Product;
import java.util.List;

public interface ProductRepository extends JpaRepository<Product, Long> {
    List<Product> findByGiacenzaGreaterThan(Integer giacenza);
}
