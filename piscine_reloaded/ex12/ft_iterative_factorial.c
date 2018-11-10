/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_iterative_factorial.c                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/06 12:49:24 by malallai          #+#    #+#             */
/*   Updated: 2018/11/06 12:49:27 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

int		ft_iterative_factorial(int nb)
{
	int i;

	i = nb;
	if (nb < 0 || i > 12)
		return (0);
	else if (nb == 0)
		return (1);
	while (i > 2)
	{
		nb *= i - 1;
		i--;
	}
	return (nb);
}
