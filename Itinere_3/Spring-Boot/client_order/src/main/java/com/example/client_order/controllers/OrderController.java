package com.example.client_order.controllers;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;

import com.example.client_order.models.Order;
import com.example.client_order.repositories.ClientRepository;
import com.example.client_order.repositories.OrderRepository;

@Controller
public class OrderController {
    final OrderRepository repo;
    final ClientRepository clientRepo;

    public OrderController(OrderRepository repo, ClientRepository clientRepo) {
        this.repo = repo;
        this.clientRepo = clientRepo;
    }

    @GetMapping("/orders")
    String index(Model model){
        model.addAttribute("orders", repo.findAll());
        return "/orders/index";
    }

    @GetMapping("/orders/create")
    String create(Model model){
       model.addAttribute("clients", clientRepo.findAll());
       return "/orders/create";
    }

    @PostMapping("/orders/store")
    String store(Order o){
        repo.save(o);
        return "redirect:/orders";
    }

    @GetMapping("/orders/show")
    String show(Long id, Model model){
        model.addAttribute("o", repo.findById(id).orElse(null));
        return "/orders/show";
    }

    @GetMapping("/orders/edit")
    String edit(Long id, Model model){
        model.addAttribute("clients", clientRepo.findAll());
        model.addAttribute("o", repo.findById(id).orElse(null));
        return "/orders/edit";
    }

    @PostMapping("/orders/update")
    String update(Order o){
        repo.save(o);
        return "redirect:/orders";
    }

    @PostMapping("/orders/destroy")
    String destroy(Long id){
        repo.deleteById(id);
        return "redirect:/orders";
    }
}
