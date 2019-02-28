/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_itoa.c                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: bclerc <bclerc@student.42.fr>              +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/10 04:23:59 by bclerc            #+#    #+#             */
/*   Updated: 2018/11/27 09:57:30 by bclerc           ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

static	int		get_len(size_t value)
{
	int count;

	count = 0;
	while (value >= 10)
	{
		value /= 10;
		count++;
	}
	return (count + 1);
}

char			*ft_itoa(int value)
{
	static char		hex[] = "0123456789";
	char			*tab;
	unsigned int	absolut;
	int				len;
	int				neg;

	neg = value < 0 ? 2 : 1;
	absolut = ft_abs(value);
	len = get_len(absolut);
	if (!(tab = ft_strnew((len + neg) - 1)))
		return (NULL);
	while (len + neg - 2 >= 0)
	{
		tab[len + neg - 2] = hex[absolut % 10];
		absolut /= 10;
		len--;
	}
	if (neg == 2)
		tab[0] = '-';
	return (tab);
}
