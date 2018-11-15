/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_itoa.c                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/12 18:02:22 by malallai          #+#    #+#             */
/*   Updated: 2018/11/15 17:36:09 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_itoa(int n)
{
	char	*result;
	int		temp;
	size_t	i;
	int		r;
	int		index;

	i = (n < 0 ? 1 : 0);
	temp = ft_abs(n);
	while (temp /= 10 != 0)
		i++;
	index = i - 1;
	result = ft_strnew(i);
	if (n < 0)
		result[0] = '-';
	while (temp != 0)
	{
		r = temp % 10;
		result[index--] = r + 48;
		temp /= 10;
	}
	result[i] = '\0';
	return (result);
}
